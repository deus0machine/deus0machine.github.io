hs.graphicsDir = 'css/graphics/';
function zero_first_format(value)
    {
        if (value < 10)
        {
            value='0'+value;
        }
        return value;
    }
function date_time()
    {
        let current_datetime = new Date();
        let day = zero_first_format(current_datetime.getDate());
        let month = zero_first_format(current_datetime.getMonth()+1);
        let year = current_datetime.getFullYear();
        let hours = zero_first_format(current_datetime.getHours());
        let minutes = zero_first_format(current_datetime.getMinutes());
        let seconds = zero_first_format(current_datetime.getSeconds());

        return day+"."+month+"."+year+" "+hours+":"+minutes+":"+seconds;
    }
const inTimer = () => {
    document.getElementById('current_date_time_block2').innerHTML = date_time();
}
inTimer();
setInterval(inTimer, 1000);

let colorDot = 0;
document.querySelector('.header').addEventListener('mouseover', () => {document.querySelector('body').classList.add('hovered'); colorDot = 1; console.log("Inside")})
document.querySelector('.header').addEventListener('mouseout', () => {document.querySelector('body').classList.remove('hovered'); colorDot = 0; console.log("Out")})
if (document.querySelector('#contPopup') !== null){
  document.querySelector('#contPopup').addEventListener('mouseover', () => {document.querySelector('body').classList.add('hovered'); colorDot = 1; console.log("Inside")})
}
    
const lerp = (a, b, n) => (1 - n) * a + n * b;

class Cursor {
  constructor() {
    // config
    this.target = { x: 0.5, y: 0.5 }; // mouse position
    this.cursor = { x: 0.5, y: 0.5 }; // cursor position
    this.speed = 0.35;
    this.init();
  }
  bindAll() {
    ["onMouseMove", "render"].forEach((fn) => (this[fn] = this[fn].bind(this)));
  }
  onMouseMove(e) {
    //get normalized mouse coordinates [0, 1]
    this.target.x = e.clientX / window.innerWidth;
    this.target.y = e.clientY / window.innerHeight;
    // trigger loop if no loop is active
    if (!this.raf) this.raf = requestAnimationFrame(this.render);
  }
  render() {
    //calculate lerped values
    this.cursor.x = lerp(this.cursor.x, this.target.x, this.speed);
    this.cursor.y = lerp(this.cursor.y, this.target.y, this.speed);
    document.documentElement.style.setProperty("--cursor-x", this.cursor.x);
    document.documentElement.style.setProperty("--cursor-y", this.cursor.y);
    //cancel loop if mouse stops moving
    const delta = Math.sqrt(
      Math.pow(this.target.x - this.cursor.x, 2) +
      Math.pow(this.target.y - this.cursor.y, 2)
    );
    if (delta < 0.001) {
      cancelAnimationFrame(this.raf);
      this.raf = null;
      return;
    }
    //or continue looping if mouse is moving
    this.raf = requestAnimationFrame(this.render);
  }
  init() {
    this.bindAll();
    window.addEventListener("mousemove", this.onMouseMove);
    this.raf = requestAnimationFrame(this.render);
  }
}
new Cursor();

(function() {
  "use strict";

  document.onmousemove = handleMouseMove;
  function handleMouseMove(event) {
    let dot, eventDoc, doc, body, pageX, pageY;
    
    event = event || window.event; // IE-ism
    if (event.pageX == null && event.clientX != null) {
      eventDoc = (event.target && event.target.ownerDocument) || document;
      doc = eventDoc.documentElement;
      body = eventDoc.body;

      event.pageX = event.clientX +
        (doc && doc.scrollLeft || body && body.scrollLeft || 0) -
        (doc && doc.clientLeft || body && body.clientLeft || 0);
      event.pageY = event.clientY +
        (doc && doc.scrollTop  || body && body.scrollTop  || 0) -
        (doc && doc.clientTop  || body && body.clientTop  || 0 );
    }

    // Add a dot to follow the cursor
    dot = document.createElement('div');
    if(colorDot == 1)
    dot.className = "dot";
    else
    dot.className = "dot1";
    dot.style.left = event.pageX -10 + "px";
    dot.style.top = event.pageY -10+ "px";
    document.body.appendChild(dot);
    setTimeout(function () {
      dot.remove();
   }, 250)
  }
})();

// Open popup function
function openPopup() {
  const popupContainer = document.getElementById("contPopup");
  popupContainer.style.opacity = 1;
  popupContainer.style.visibility = "visible";
  document.getElementById("cursor").style.backgroundColor = "#ffffff";
  document.querySelector('body').style.position = "fixed";
}

// Close popup function
function closePopup() {
  const popupContainer = document.getElementById("contPopup");
  popupContainer.style.opacity = 0;
  popupContainer.style.visibility = "hidden";
  document.querySelector('body').style.position = "static";
}
document.getElementById("popup").addEventListener('click', {
  handleEvent(event) {
    console.log("clickOnPopup");
    event.stopPropagation();
  }
});
document.getElementById("contPopup").addEventListener('click', {
  handleEvent(event) {
    console.log("clickOutsidePopup");
    closePopup();
  }
});
