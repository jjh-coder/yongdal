<?php

class SimpleSmtpMailer

{

    private $socket;

    private $host;

    private $port;

    private $username;

    private $password;

    private $encryption;

    private $timeout;

    public function __construct($host, $port, $username, $password, $encryption, $timeout)

    {

        $this->host = $host;

        $this->port = $port;

        $this->username = $username;

        $this->password = $password;

        $this->encryption = $encryption; // tls, ssl, none

        $this->timeout = $timeout;

    }

    public function send($from, $to, $subject, $body, $fromName, $toName)

    {

        $this->connect();

        $this->expect(array(220));

        $this->command('EHLO localhost', array(250));

        if ($this->encryption === 'tls') {

            $this->command('STARTTLS', array(220));

            $cryptoMethod = defined('STREAM_CRYPTO_METHOD_TLS_CLIENT')

                ? STREAM_CRYPTO_METHOD_TLS_CLIENT

                : STREAM_CRYPTO_METHOD_SSLv23_CLIENT;

            if (stream_socket_enable_crypto($this->socket, true, $cryptoMethod) !== true) {

                throw new Exception('TLS ���� Ȱ��ȭ ����');

            }

            $this->command('EHLO localhost', array(250));

        }

        if ($this->username !== '') {

            $this->command('AUTH LOGIN', array(334));

            $this->command(base64_encode($this->username), array(334));

            $this->command(base64_encode($this->password), array(235));

        }

        $this->command('MAIL FROM:<' . $from . '>', array(250));

        $this->command('RCPT TO:<' . $to . '>', array(250, 251));

        $this->command('DATA', array(354));

        $message = $this->buildMessage($from, $to, $subject, $body, $fromName, $toName);

        fwrite($this->socket, $message . "\r\n.\r\n");

        $this->expect(array(250));

        $this->command('QUIT', array(221));

        fclose($this->socket);

        return true;

    }

    private function connect()

    {

        $target = $this->host;

        if ($this->encryption === 'ssl') {

            $target = 'ssl://' . $this->host;

        }

        $errno = 0;

        $errstr = '';

        $this->socket = fsockopen(

            $target,

            $this->port,

            $errno,

            $errstr,

            $this->timeout

        );

        if (!$this->socket) {

            throw new Exception('SMTP ���� ����: ' . $errno . ' ' . $errstr);

        }

        stream_set_timeout($this->socket, $this->timeout);

    }

    private function command($command, $expectedCodes)

    {

        fwrite($this->socket, $command . "\r\n");

        return $this->expect($expectedCodes);

    }

    private function expect($expectedCodes)

    {

        $response = '';

        while (($line = fgets($this->socket, 515)) !== false) {

            $response .= $line;

            if (preg_match('/^\d{3}\s/', $line)) {

                break;

            }

        }

        $code = intval(substr($response, 0, 3));

        if (!in_array($code, $expectedCodes, true)) {

            throw new Exception('SMTP ����: ' . $response);

        }

        return $response;

    }

    private function buildMessage($from, $to, $subject, $body, $fromName, $toName)

    {

        $fromHeader = $from;

        if ($fromName !== '') {

            $fromHeader = $this->encodeHeader($fromName) . ' <' . $from . '>';

        }

        $toHeader = $to;

        if ($toName !== '') {

            $toHeader = $this->encodeHeader($toName) . ' <' . $to . '>';

        }

        $headers = array();

        $headers[] = 'From: ' . $fromHeader;

        $headers[] = 'To: ' . $toHeader;

        $headers[] = 'Subject: ' . $this->encodeHeader($subject);

        $headers[] = 'Date: ' . date('r');

        $headers[] = 'MIME-Version: 1.0';

        $headers[] = 'Content-Type: text/plain; charset=UTF-8';

        $headers[] = 'Content-Transfer-Encoding: base64';

        return implode("\r\n", $headers)

            . "\r\n\r\n"

            . chunk_split(base64_encode($body));

    }

    private function encodeHeader($text)

    {

        return '=?UTF-8?B?' . base64_encode($text) . '?=';

    }

}

?>