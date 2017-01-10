$(document).ready(function () {
    $('.follow').click(function () {
        var self = $(this);

        $.post(laroute.route('follows', {user: self.data('id')}), function() {
            if (self.hasClass('following')) {
                self.text(self.data('follow'));
            } else {
                self.text(self.data('following'));
            }

            self.toggleClass('following');
        });
    });

    $('.follow').hover(function () {
        if ($(this).hasClass('following')) {
            $(this).text($(this).data('unfollow'));
        }
    }, function () {
        if ($(this).hasClass('following')) {
            $(this).text($(this).data('following'));
        }
    });
});
