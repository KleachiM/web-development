function main() {  
  const popup = document.createElement('div');
  popup.classList.add('popup');
  popup.addEventListener('click', onPopupClose);
  const popup_content = document.createElement('div');
  popup_content.classList.add('popup-content');
  popup_content.addEventListener('click', onPopupClick);

  const btns = document.getElementsByClassName('button');
  for (let index= 0; index < btns.length; index++) {
    btns[index].addEventListener('click', onBtnClick);
  }
  
  window.addEventListener('scroll', onWinScroll);

  document.addEventListener('keydown', function(event) { // закрытие попапа по Esc
    const key = event.key;
    if (key === "Escape") {
        onPopupClose(event);
    }
  });

  function onWinScroll(event) {
    event.preventDefault();
    event.stopPropagation();
  }
  
  function onBtnClick() {
    document.body.appendChild(popup);
    popup.appendChild(popup_content);
    document.body.classList.add('scroll_lock');
  }
  
  function onPopupClick(event) {
    event.preventDefault();
    event.stopPropagation();
  }

  function onPopupClose(event) {
    console.log(event);
    event.preventDefault();
    event.stopPropagation();
    popup.removeChild(popup_content);
    document.body.removeChild(popup);
    document.body.classList.remove('scroll_lock');
  }

}

console.log('ok');
main();
// console.log('ok');