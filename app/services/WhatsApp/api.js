const btn = document.querySelectorAll(".btn_contact").forEach(function(btn) {
  btn.addEventListener("click", function() {

    // Get data
    const user_name = this.dataset.name;
    const business_name = this.dataset.business_name;
    const user_phone = this.dataset.phone;

    // Message
    const message = `Olá, ${user_name} 👋🏻%0A%0AÉ um prazer entrar em contato com você! Sou da empresa *${business_name}* e gostaria de informar que sua solicitação para cantar em nosso estabelecimento foi *analisada e aprovada*! Estamos muito animados em trabalhar com você e tenho certeza que juntos podemos fazer eventos incríveis! 🤩%0A%0AGostaríamos de conversar mais sobre como podemos colaborar e garantir que seu talento brilhe em nosso local. Por favor, envie-nos uma mensagem de volta para podermos discutir mais detalhes sobre a apresentação e eventuais necessidades técnicas. 🎤%0A%0AAgradecemos desde já e esperamos ansiosamente por uma parceria de sucesso! 🤝`;
    
    //Api URL
    const url = `https://api.whatsapp.com/send/?phone=${user_phone}&text=${message}&type=phone_number&app_absent=0`;

    // Open
    window.open(url, "_blank");
  })
});
