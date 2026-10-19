달에울다님의 소스를 약간 수정했습니다.

달에울다님의 허락을 받은터라 올립니다.

소스가 괜찮은것 같아서 이렇게 저렇게 허접하게 수정을 했습니다.

그래도 꽤 깔끔하게 보이도록 애썼습니다.

제로보드를 사용하게 되면 주소 마지막 부분에 몇개 깨지는게 있어서.

저도 가입신청서의 주소검색에서 자꾸 뭔가가 찜찜했거든요..^^

물론 달에울다님의 말씀대로 우편번호 디비가 제로보드에 있어서 고칠수도 없었구요..

이걸 디비로 할까 하다가 그냥 파일로 했습니다. 약간 차이는 있지만 그럭저럭 

쓸만해서요.. 여차 잡다한 얘기는 여기서 접고.. 방법으로 들어가겠습니다.

압축을 푸시면 

zipcode.db : 우편번호 디비파일 (2003.02.17.버전)
zipcode.php
zipcode2.php

이렇게 세개가 있습니다.

이 모든 파일을 제로보드의 zipcode 폴더에 업로드 시킵니다.

다음은 member_join.php와 member_modify.php 파일을 수정해야 합니다.

두개의 파일에 보시면 팝업 자바스크립트가

function address_popup(num) {
  window.open('zipcode/search_zipcode.php?num='+num,'searchaddress','width=440,height=230,scrollbars=yes');
}

이 함수는 더이상 제로보드 주소검색을 사용하지 않으시려면 이 함수와
    
    zipcode/search_zipcode.php
    zipcode/search_zipcode2.php
    zipcode/search_zipcode3.php

이 세개의 파일들과 함께 삭제 하시면 됩니다. 놔두셔도 아무런 문제는 없습니다.

우선 테스트해 보고 삭제하시기를 바랍니다.괜히 나중에 안된다고 하지 마시구요.^^;

이렇게 써있을 꺼에요. 그 아래에다 아래의 함수를 하나 더 추가 하거나 변경합니다.

function zipcode(form,address) {
  window.open('zipcode/zipcode.php?form='+form+'&address='+address,'searchaddress','left=100,top=100,width=445,height=400,scrollbars=yes');
}

두개의 파일(member_join.php와 member_modify.php)에 찾아서 각각 추가해주시면 됩니다.

그리고 이제 주소찾기 링크를 바꿔줘야 합니다.

두번째에서 자바스크립 함수를 추가해주셨던 member_join.php와 member_modify.php 파일에

집주소찾기 버튼 하고 회사주소찾기 버튼 이 두개가 있습니다.

집주소찾기
    onclick=address_popup(1) 을 =====> onclick=zipcode('write','home_address') 로 변경

회사주소찾기
    onclick=address_popup(2) 를 =====> onclick=zipcode('write','office_address') 로 변경

그럼 테스트 해보세요..

안되시면 코멘트 남겨주세욤..
