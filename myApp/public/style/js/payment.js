/* eslint-disable no-undef */
const buttonContainer = document.getElementById("button-container");
const contentContainer = document.getElementById("content-container");
let isOpen = false;
let config = {
    RETURN_URL: window.location.origin,
    ELEMENT_ID: "embeded-payment-container",
    CHECKOUT_URL: "",
    embedded: true,
    onSuccess: (event) => {
        contentContainer.innerHTML = `
        <div style="padding-top: 20px; padding-bottom:20px">
            Thanh toan thanh cong
        </div>
    `;
        buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
            width: 100%;
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            font-size: 15px;
            "
        >
            Quay lại trang thanh toán
        </button>
    `;
    },
};
buttonContainer.addEventListener("click", async (event) => {
    if (isOpen) {
        const { exit } = PayOSCheckout.usePayOS(config);
        exit();
        contentContainer.innerHTML = `
        <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>
        <p><strong>Giá tiền:</strong> 2000 VNĐ</p>
        <p><strong>Số lượng:</strong> 1</p>
    `;
    } else {
        const checkoutUrl = await getPaymentLink();
        config = {
            ...config,
            CHECKOUT_URL: checkoutUrl,
        };
        const { open } = PayOSCheckout.usePayOS(config);
        open();
    }
    isOpen = !isOpen;
    changeButton();
});

document.getElementById("create-payment-link-btn").addEventListener("click", function () {
    // Make an AJAX request to your Laravel backend to generate the payment link
    fetch('/admin/create-payment-link', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.checkoutUrl) {
                window.location.href = data.checkoutUrl;
            } else {
                console.error("Error creating payment link");
            }
        })
        .catch(error => console.error('Error:', error));
});

const getPaymentLink = async () => {
    const response = await fetch(
        "http://localhost:3030/create-embedded-payment-link",
        {
            method: "POST",
        }
    );
    if (!response.ok) {
        console.log("server doesn't response!");
    }
    const result = await response.json();
    return result.checkoutUrl;
};

const changeButton = () => {
    if (isOpen) {
        buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
            width: 100%;
            background-color: gray;
            color: white;
            border: none;
            padding: 10px;
            font-size: 15px;
            "
        >
            Đóng link thanh toán
        </button>
      `;
    } else {
        buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
                width: 100%;
                background-color: blue;
                color: white;
                border: none;
                padding: 10px;
                font-size: 15px;
            "
            >
            Tạo Link thanh toán
        </button>
    `;
    }
};
    function convertAmount() {
    const amountInput = document.getElementById("amount").value;
    const amountTextElement = document.getElementById("amountText");

    if (amountInput && Number(amountInput) < 10000000) {
    amountTextElement.textContent = `${convertToVietnameseCurrencyText(Number(amountInput))} đồng`;
} else {
    amountTextElement.textContent = "";
}
}

    function convertToVietnameseCurrencyText(number) {
    if (number === 0) return "không";

    const units = ["", "nghìn", "triệu", "tỷ"];
    let parts = [];
    let unitIndex = 0;

    while (number > 0) {
    const segment = number % 1000;
    if (segment > 0) {
    parts.unshift(segmentToWords(segment) + (units[unitIndex] ? " " + units[unitIndex] : ""));
}
    number = Math.floor(number / 1000);
    unitIndex++;
}

    return parts.join(" ").trim();
}

    function segmentToWords(segment) {
    const words = ["không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"];
    let result = "";
    const hundreds = Math.floor(segment / 100);
    const tens = Math.floor((segment % 100) / 10);
    const ones = segment % 10;

    if (hundreds > 0) {
    result += words[hundreds] + " trăm ";
} else if (tens > 0 || ones > 0) {
    result += " ";
}

    if (tens > 1) {
    result += words[tens] + " mươi ";
    if (ones === 1) {
    result += "mốt ";
} else if (ones > 0) {
    result += words[ones] + " ";
}
} else if (tens === 1) {
    result += "mười ";
    if (ones > 0) {
    result += words[ones] + " ";
}
} else if (ones > 0) {
    if (ones === 5 && segment >= 10) {
    result += "lăm ";
} else {
    result += words[ones] + " ";
}
}

    return result.trim();
}
