<div class="box">
    <span class="text">chon ngay thang nam <br /></span>
    <select id="ngay">
        <option value="0">chon ngay</option>
        <?php
        for ($i = 1; $i < 31; $i++) {
            echo "<option value = '$i'>Ngay $i</option>";
        }
        ?>
    </select>
    <select id="thang">
        <option value="0">chon thang</option>
        <?php
        for ($i = 1; $i < 12; $i++) {
            echo "<option value = '$i'>Ngay $i</option>";
        }
        ?>
    </select>
    <select id="nam">
        <option value="0">chon nam</option>
        <?php
        for ($i = 1930; $i < 2020; $i++) {
            echo "<option value = '$i'>Ngay $i</option>";
        }
        ?>
    </select>
</div>
<style>
    .text {
        position: absolute;
        /* Đặt chữ lên trên border */
        z-index: 1;
        /* Đảm bảo chữ hiển thị trên border */
        background-color: white;
        bottom: 40px;
    }

    .box {
        position: relative;
        /* Đặt position của box là relative */
        width: 500px;
        height: 50px;
        border: 5px solid #000;
        /* Đường viền cho box */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #ngay {
        color: #ffcc00;
        font-size: 20px;
        top: 30px;
    }

    #thang {
        background-color: antiquewhite;
        font-size: 20px;
    }

    #nam {
        color: #ffcc00;
        background-color: red;
    }

    select {
        margin-right: 20px;
    }
</style>