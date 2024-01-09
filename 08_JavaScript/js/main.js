$(function () {
    /**
    * 画面固定
    */
    window.open("javascript:window.addEventListener('resize', function (e) {window.resizeTo(300, 300); }, false);", "Good Luck.", "top=０, left=０, width=1920, height=5000");

    /**
     * モーダル
     */
    $('.nav-list10 > .click').on('click', function () {
        var modalContent = '<figure class="modal main"><img src="zu/img/main01.png" alt=""></figure>';

        $('#overlay').html(modalContent).addClass('fade-in');
        $('#overlay').on('click', function () {
            $('#overlay').removeClass('fade-in');
        });
    });
    $('.nav-list11 > .click').on('click', function () {
        var modalContent = '<figure class="modal main"><img src="zu02/img/main01.png" alt=""></figure>';

        $('#overlay').html(modalContent).addClass('fade-in');
        $('#overlay').on('click', function () {
            $('#overlay').removeClass('fade-in');
        });
    });
    $('.nav-list12 > .click').on('click', function () {
        var modalContent = '<figure class="modal main"><img src="zu03/img/main01.png" alt=""></figure><figure class="modal main2">';

        $('#overlay').html(modalContent).addClass('fade-in');
        $('#overlay').on('click', function () {
            $('#overlay').removeClass('fade-in');
        });
    });
});