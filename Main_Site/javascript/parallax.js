(function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector("#parallax");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/150;
        let _h = window.innerHeight/150;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
        let _depth1 = `${100 - (_mouseX - _w) * 0.01}% ${100 - (_mouseY - _h) * 0.01}%`;
        let _depth2 = `${100 - (_mouseX - _w) * 0.02}% ${100 - (_mouseY - _h) * 0.02}%`;
        let _depth3 = `${100 - (_mouseX - _w) * 0.05}% ${100 - (_mouseY - _h) * 0.04}%`;
        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
        console.log(x);
        elem.style.backgroundPosition = x;
    }
})();