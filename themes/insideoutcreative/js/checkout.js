// alert('hello');

let billingAdress1 = document.querySelector('#billing_address_1');
let changePaymentMethod = document.querySelector('.change_payment_method');

if(changePaymentMethod){
changePaymentMethod.innerText = 'Change payment method';
}

// console.log(billingAdress1);


// billingAdress1.placeholder = 'Address and street name';
// billingAdress1.attr("data-placeholder","Address and street name");

window.onload = function (e) {
	if(billingAdress1){
    billingAdress1.placeholder = 'Address and street name';
	}
};