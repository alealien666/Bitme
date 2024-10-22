document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]')
    const subtotalElement = document.getElementById('subtotal')
    const totalElement = document.getElementById('total')
    const diskonElement = document.getElementById('diskon')
    const disableButtonStok = document.querySelectorAll('#dis,#diss,.not')
    const productCounters = document.querySelectorAll('.jumlah')
    const plusButtons = document.querySelectorAll('.plus')
    const minusButtons = document.querySelectorAll('.min')

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateSubtotal()
        })
    })

    plusButtons.forEach(function (button, index) {
        let stock = document.querySelectorAll('#stok')[index].getAttribute('data-stok')
        const inputJumlah = productCounters[index].querySelector('input[type="hidden"]')
        button.addEventListener('click', function () {
            if (inputJumlah.value === stock) {
                button.style.backgroundColor = 'white'
                button.style.opacity = 0.5
            } else {
                incrementCount(index)
            }
        })
    })
    minusButtons.forEach(function (button, index) {
        button.addEventListener('click', function () {
            decrementCount(index)
        })
    })

    function updateSubtotal() {
        let subtotal = 0
        checkboxes.forEach(function (checkbox, index) {
            if (checkbox.checked) {
                const harga = parseFloat(checkbox.getAttribute('data-harga'))
                if (!isNaN(harga)) {
                    const count = parseInt(productCounters[index].querySelector('.count').textContent, 10)
                    subtotal += harga * count
                    console.log(harga)
                }
            }
        })
        subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID')
        updateTotal(subtotal)
    }

    let diskon = 0;
    let totalSebelumDiskon = 0;

    function updateTotal(subtotal) {
        // totalSebelumDiskon = 0
        let total = subtotal

        if (total >= 30000) {
            diskon = 10000
            totalSebelumDiskon = total
            total -= diskon
        } else {
            diskon = 0
            totalSebelumDiskon = total
        }

        totalElement.textContent = 'Rp. ' + total.toLocaleString('id-ID')
        diskonElement.textContent = '- Rp. ' + diskon.toLocaleString('id-ID')
    }

    function incrementCount(index) {
        const jumlah = productCounters[index].querySelector('.count')
        let count = parseInt(jumlah.textContent, 10) //ngekonversi bilangan bulat desimal basis 10
        count++
        jumlah.textContent = count

        const inputJumlah = productCounters[index].querySelector('input[type="hidden"]')
        inputJumlah.value = count
        updateSubtotal()

    }


    function decrementCount(index) {
        const jumlah = productCounters[index].querySelector('.count')
        let count = parseInt(jumlah.textContent, 10)
        if (count > 0) {
            count--
            jumlah.textContent = count

            const inputJumlah = productCounters[index].querySelector('input[type="hidden"]')
            inputJumlah.value = count

            updateSubtotal()
        }
    }
    // disable button stok 0
    disableButtonStok.forEach(disableButton => {
        disableButton.disabled = 'true'
        disableButton.style.backgroundColor = 'white'
    })
})

// order 
const onButtonSubmitPressed = () => {
    localStorage.setItem('buttonSubmitPressed', true)
}
const buttonSubmit = document.getElementById('buttonPesan')
buttonSubmit.addEventListener('click', onButtonSubmitPressed)

const saveReload = () => {
    const personalInfoTab = document.getElementById('pills-bill-info-tab')
    const detailPesanTab = document.getElementById('pills-bill-address-tab')
    const detailPesan = document.getElementById('pills-bill-address')
    const personalInfo = document.getElementById('pills-bill-info')
    const buttonPesanSekarang = document.getElementById('buttonPesan')
    const checkboxes = document.querySelectorAll('input[type="checkbox"]')
    const disableButtonStok = document.querySelectorAll('.plus, .min')
    const buttonSubmitPressed = JSON.parse(localStorage.getItem('buttonSubmitPressed'))
    const tabelProduct = document.getElementById('table')


    if (buttonSubmitPressed === true) {
        tabelProduct.style.opacity = 0.5

        disableButtonStok.forEach(disableButton => {
            disableButton.disabled = true
            disableButton.style.cursor = 'notAllowed'
            disableButton.style.backgroundColor = 'white'
        })

        checkboxes.forEach(checkbox => {
            checkbox.disabled = true
            checkbox.style.cursor = 'notAllowed'
        })
        personalInfo.classList.remove('show', 'active')
        personalInfoTab.disabled = true
        personalInfoTab.classList.remove('active')
        detailPesanTab.classList.add('active')
        detailPesanTab.disabled = false
        detailPesan.classList.add('show', 'active')
        buttonPesanSekarang.style.display = 'none'

        localStorage.setItem('buttonSubmitPressed', false)
    }
}

document.addEventListener('DOMContentLoaded', saveReload)

// redirect pages
const redirectPage = () => {
    const personalInfoTab = document.getElementById('pills-bill-info-tab')
    const detailPesanTab = document.getElementById('pills-bill-address-tab')
    const detailPesan = document.getElementById('pills-bill-address')
    const personalInfo = document.getElementById('pills-bill-info')
    const buttonPesanSekarang = document.getElementById('buttonPesan')
    const checkboxes = document.querySelectorAll('input[type="checkbox"]')
    const disableButtonStok = document.querySelectorAll('.plus, .min')
    const tabelProduct = document.getElementById('table')

    tabelProduct.style.opacity = 1

    disableButtonStok.forEach(disablebutton => {
        disablebutton.disabled = false
        disablebutton.style.cursor = 'pointer'
    })

    checkboxes.forEach(checkbox => {
        checkbox.disabled = false
        checkbox.style.cursor = 'pointer'
    });

    personalInfo.classList.add('show', 'active')
    personalInfo.classList.remove('bege')
    detailPesan.classList.remove('show', 'active')
    personalInfoTab.removeAttribute('disabled')
    personalInfoTab.classList.add('active')
    detailPesanTab.classList.remove('active')
    detailPesanTab.setAttribute('disabled', true)
    buttonPesanSekarang.style.display = 'inlineBlock'

    localStorage.removeItem('buttonSubmitPressed')

    window.open('https://wa.me/6285854950450', '_blank')
    window.location.href = '../user/riwayat-pemesanan'
}

const disable = document.querySelector('.hx')
const nama = document.querySelector('#nama-user')
const no = document.querySelector('#no-telp')
const imel = document.querySelector('#email')
const alamat = document.querySelector('#alamat')

nama.setAttribute('disabled', 'true')
imel.setAttribute('disabled', 'true')
no.setAttribute('disabled', 'true')
alamat.setAttribute('disabled', 'true')
disable.setAttribute('disabled', 'true')






