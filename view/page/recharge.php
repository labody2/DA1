<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền</title>
</head>
<body>
  <?php
  include 'C:\Users\dungv\Desktop\DA1\admin\start_session.php';
  ?>
    <!-- component -->
    <form action="/controller/controller_account.php" method="POST">
<div class="font-manrope flex h-screen w-full items-center justify-center">
  <div class="mx-auto box-border w-[465px] border bg-white p-4">
    <div class="flex items-center justify-between">
      <span class="text-[#64748B]">Nạp tiền</span>
      <div class="cursor-pointer border rounded-[4px]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#64748B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    </div>

    <div class="mt-6">
        <div class="font-semibold">Bạn muốn nạp tiền vào tài khoản bao nhiêu?</div>
        <div><input id="amountInput" class="mt-1 w-full rounded-[4px] border border-[#A0ABBB] p-2" value="" type="number" placeholder="10,000đ" oninput="updateSendAmount()" name="amount"/></div>
        <div class="flex justify-between" >
            <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-[#191D23]" onclick="changeAmount('50000')">50,000đ</div>
            <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-[#191D23]" onclick="changeAmount('100000')">100,000đ</div>
            <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-green-700 p-3 text-[#191D23]" onclick="changeAmount('200000')">200,000đ</div>
            <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-[#191D23]" onclick="changeAmount('500000')">500,000đ</div>
        </div>
    </div>



    <div class="mt-6">
      <div class="font-semibold">Hình thức</div>
      <div class="mt-2">
        <div class="flex w-full items-center justify-between bg-neutral-100 p-3 rounded-[4px]"onclick="toggleBankTransfer()" style="cursor: pointer;" >
          <div class="flex items-center gap-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#299D37]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-semibold">Chuyển khoản ngân hàng</span>
          </div>
          <div class="flex items-center gap-x-2">
            <div class="text-[#64748B]">Vietcombank</div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>
      </div>
    </div>
<script>
              function toggleBankTransfer() {
                  const bankTransferInfo = document.getElementById("bankTransferInfo");
                  if (bankTransferInfo.style.display === "block") {
                      bankTransferInfo.style.display = "none";
                  } else {
                      bankTransferInfo.style.display = "block";
                  }
              }
          </script>
    <div class="mt-6">
    <div id="bankTransferInfo" class="hidden mt-3 p-3 bg-white rounded-md shadow-md">
              <!-- Nội dung của div khi hiển thị -->
              <p>Thông tin chuyển khoản ngân hàng:</p>
              <p>Tên người nhận: Vũ Tiến Dũng</p>
              <p>Số tài khoản: 1012352059</p>
              <p>Nội dung chuyển khoản: Nap tien <?=$_SESSION["username"]?></p>
            </div>

    <div class="mt-6">
        <input type="text" value="<?=$_SESSION["username"]?>" readonly class="hidden" name="name">
      <button type="submit" class="w-full cursor-pointer rounded-[4px] bg-green-700 px-3 py-[6px] text-center font-semibold text-white" id="sendAmount" value="">Đánh dấu đã nạp 0,000đ</button>
      </form>
    </div>
    <script>
    function updateSendAmount() {
        const amountInput = document.getElementById("amountInput");
        const sendAmount = document.getElementById("sendAmount");
        const amount = parseFloat(amountInput.value);
        const formattedAmount = numberWithCommas(amount);
        sendAmount.textContent = `Đánh dấu đã nạp ${formattedAmount}đ`;
        sendAmount.setAttribute("value", amount); 
    }

    function changeAmount(amount) {
        const amountInput = document.getElementById("amountInput");
        amountInput.value = amount;
        updateSendAmount();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
  </div>
</div>
</body>
</html>