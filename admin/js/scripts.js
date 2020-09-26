ClassicEditor.create(document.querySelector('#editor')).catch((error) => {
  console.error(error);
});

$(document).ready(() => {
  console.log('ready');
  $('#selectAllBoxes').click(function (event) {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        console.log('checkBox');
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });
});
