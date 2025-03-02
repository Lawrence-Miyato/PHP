<div id="chao">
    <?php
    $h = (gmdate("H") + 7) % 24;
    if ($h <= 12 && $h >= 1) {
        echo "<span class='sang'>Bây giờ là $h giờ sáng! Chúc một ngày tốt lành</span>";
    } else
    if ($h < 18 && $h >= 13) {
        echo "<span class='chieu'>Bây giờ là $h giờ chiều! Chúc bạn vui vẻ </span>";
    } else
        echo "<span class='toi'>Bây giờ là $h giờ tối! chúc bạn ngủ ngon </span>";
    ?>
</div>

<style>
    /* Định kiểu chung cho #chao */
    #chao {
        font-family: Arial, sans-serif;
        font-size: 18px;
        text-align: center;
        padding: 20px;
    }

    /* Định kiểu cho phần sáng */
    .sang {
        color: #ffcc00;
        /* Màu vàng sáng */
        font-weight: bold;
        font-size: 20px;
    }

    /* Định kiểu cho phần chiều */
    .chieu {
        color: #ff7f50;
        /* Màu cam */
        font-weight: bold;
        font-size: 20px;
    }

    /* Định kiểu cho phần tối */
    .toi {
        color: #4b0082;
        /* Màu tím tối */
        font-weight: bold;
        font-size: 20px;
    }
</style>