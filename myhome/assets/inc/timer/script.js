function changeMonth(el) {
    let $this=$(el);
    if ($this.val() == 1 || $this.val() == 2 || $this.val() == 3 || $this.val() == 4 || $this.val() == 5 || $this.val() == 6) {
        $this.parent().find('.everyDay').removeClass('d-none');
    } else {
        if ($this.val() == 7 || $this.val() == 8 || $this.val() == 9 || $this.val() == 10 || $this.val() == 11) {
            if ($this.parent().find('.day').val() == 31) {
                $this.parent().find('.day').val(30);
            }
            $this.parent().find('.everyDay').removeClass('d-none');
            if (!$this.parent().find('.everyDay').last().hasClass('d-none')) {
                $this.parent().find('.everyDay').last().addClass('d-none');
            }
        } else {
            if ($this.val() == 12) {
                if ($this.parent().find('.day').val() == 31 || $this.parent().find('.day').val() == 30) {
                    $this.parent().find('.day').val(29);
                }
                $this.parent().find('.everyDay').removeClass('d-none');
                if (!$this.parent().find('.everyDay').last().hasClass('d-none')) {
                    $this.parent().find('.everyDay').last().addClass('d-none');
                }
                if (!$this.parent().find('.everyDay').eq(-2).hasClass('d-none')) {
                    $this.parent().find('.everyDay').eq(-2).addClass('d-none');
                }
            } else {
                return false;
            }
        }
    }
}