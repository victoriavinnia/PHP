let form = document.forms.formUrl;
//отправка формы с перезагрузкой страницы
form.addEventListener('submit', formHandler);
function formHandler(event) {
    event.preventDefault();
    if(!validate(this)) return;
// отправка данных формы на сервер с перезагрузкой страницы
    this.submit();
}
