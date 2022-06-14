
document.addEventListener("DOMContentLoaded", function (event) {

  const btnPayment = document.querySelectorAll(".je-paye");
  paymentanimation = document.querySelector(".payment-animation");


    function changeClass() {
        if (btnPayment) {
            btnPayment.forEach(l => l.classList.add('en-cours'))
            paymentanimation.classList.add('afficher')
        }
    }
    btnPayment.forEach(l => l.addEventListener('click', changeClass))


});


function paiementAnimation(){
  const btnPayment = document.querySelectorAll(".je-paye");
  paymentanimation = document.querySelector(".payment-animation");


    function changeClass() {
        if (btnPayment) {
            btnPayment.forEach(l => l.classList.add('en-cours'))
            paymentanimation.classList.add('afficher')
        }
    }
    btnPayment.forEach(l => l.addEventListener('click', changeClass))

};

class Loader {

  constructor(element) {
    this.element = element;
    this.spinning = 0;
    this.state = null;

    this.svgPaths = {
      success: "M17.5,42.3l23.2-23.2L23.9,35.9l-17-17c3.4-8.1,11.3-13.7,20.6-13.7c12.3,0,22.3,10,22.3,22.3 s-10,22.3-22.3,22.3S5.2,39.8,5.2,27.5c0-3.1,0.6-6,1.7-8.6",
      error: "M15.8,39.2l23.4-23.4v23.4L11.7,11.7c4-4,9.6-6.5,15.8-6.5c12.3,0,22.3,10,22.3,22.3s-10,22.3-22.3,22.3 S5.2,39.8,5.2,27.5c0-6.2,2.5-11.8,6.6-15.8"
    }

    this._onIteration = (e) => {
      console.log(this.spinning);
      if(this.spinning) {
        if(this.spinning > 1) {
          this.element.classList.remove("loading");
        } else {
          if(this.state === true) {
            this.element.classList.add("success");
          } else if(this.state === false) {
            this.element.classList.add("error");
          }

          if(this.state !== null) {
            this.spinning ++;
          }
        }
      }
    }
    this.element.addEventListener("animationiteration", this._onIteration);
    this.element.querySelector('.loader-path').addEventListener('animationend', this.animationEndCallback)
  }

  resetIt() {
    this.element.classList.remove("success", "error");
    this.element.classList.add("loading");
    this.spinning = 0;
    this.state = null;
  }

  trueIt(callback = this.animationEndCallback) {
    if(this.state !== true) {
      if(this.state === false) this.resetIt();
      this.spinning = 1;
      this.state = true;
      this.element.querySelector('.loader-path').setAttribute("d", this.svgPaths.success);
      this.animationEndCallback = callback;
    }
  }

  falseIt(callback = this.animationEndCallback) {
    if(this.state !== false) {
      if(this.state === true) this.resetIt();
      this.spinning = 1;
      this.state = false;
      this.element.querySelector('.loader-path').setAttribute("d", this.svgPaths.error);
      this.animationEndCallback = callback;
    }
  }
}

function valideePaiementAnimation() {
  const loader = new Loader(document.querySelector('.loader'))
  loader.trueIt();
}

function erreurPaiementAnimation() {
  const loader = new Loader(document.querySelector('.loader'))
  loader.falseIt();
}

function resetPaiementAnimation(){
  const loader = new Loader(document.querySelector('.loader'))
  loader.resetIt();

}




