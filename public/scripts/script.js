$(function(){
  'use strict';
  if($("#menuBtn") != null){
    drwer();
  }
  if($("#addChoiceInput")[0] != null){
    choiceInputBtn();
  }

  if($(".accordion_ul")!= null){
    slide();
  }
  if($("h2.greet").length > 0){
    greetInDrwer();
  }
  if($(".childInCreateCategoryBox") != null){
    createCategory();
  }
});

function createCategory(){
  var $createCategoryBox = $('.childInCreateCategoryBox');
  var $childCategory = $('.childCategory');
var original = $childCategory.html(); //後のイベントで、不要なoption要素を削除するため、オリジナルをとっておく

$('.parentCategory').change(function() {

  //選択された親のvalueを取得し変数に入れる
  var val1 = $(this).val();

  //削除された要素をもとに戻すため.html(original)を入れておく
  $childCategory.html(original).find('option').each(function() {
    var val2 = $(this).data('val'); //data-valの値を取得

    //valueと異なるdata-valを持つ要素を削除
    if (val1 != val2) {
      $(this).not(':first-child').remove();
    }
  });

  //親側のselect要素が未選択の場合、都道府県をdisabledにする
  if ($(this).val() == "") {
    $createCategoryBox.addClass('hidden');
    $childCategory.attr('disabled', 'disabled');
  } else {
    $createCategoryBox.removeClass('hidden');
    $childCategory.removeAttr('disabled');
  }

});
}
function greetInDrwer(){
  let greet = document.querySelector('h2.greet');
  var greetText = greet.textContent;
  if(greetText.length  > 10){
    greet.textContent=greetText.slice(0,10)+'...';
  }
}

function slide(){
  $('.accordion_ul ul').hide();
    $('.accordion_ul h1').click(function(e){
      if($(this).hasClass('rotate225')){
        $(this).removeClass('rotate225');
      }else{
        $(this).addClass('rotate225');
      }
    $(this).next("ul").slideToggle();
  });
}


function choiceInputBtn(){
  let $choicesList = document.getElementById('choicesList');
  let $hiddenChoice = document.getElementById('hiddenChoice');

  document.getElementById('addChoiceInput').addEventListener('click',function(e){
    let $li = document.createElement('li');
    let $clone = $hiddenChoice.cloneNode(true);
    $clone.setAttribute('type','text');
    $li.appendChild($clone);
    $choicesList.appendChild($li);
  },false);

  document.getElementById('removeChoiceInput').addEventListener('click',function(e){
    let $lastChoice = $choicesList.lastElementChild;
    $choicesList.removeChild($lastChoice);
  });
}


function drwer(){
  var menu = $('.drwerMenuBox');
	var btn = $('#menubtn');

		$('.overlay').prepend('<div class="btnCloseBox"><img src="./image/icon/btnClose.png"></div>');


	btn.on('click',function(){
		btn.addClass('drawer');
		if($(this).hasClass('drawer')){
			menu.stop().animate({left:'0px'});
		  $('.overlay').css({display:'block'});
		}

	});
	$('.btnCloseBox img').on('click',function(){
		menu.stop().animate({left:'-250px'});
		$('.overlay').css({display:'none'});
	});
	$('.overlay').on('click',function(){
		menu.stop().animate({left:'-250px'});
		$(this).css({display:'none'});
	});
}
