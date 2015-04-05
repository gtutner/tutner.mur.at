// Sound-FX de-/activation
function fx(x) {
		var e1 = document.getElementById('headerpic');
		var e2 = document.getElementById('b_speaker');
		if (x) {
			e1.setAttribute('onmouseover','mouseoversound.playclip()');
			e2.setAttribute('onclick','fx(0)');
			e2.setAttribute('title','FX OFF');
			e2.setAttribute('src','styles/button_speaker_on.png');
		} else {
			e1.removeAttribute('onmouseover');
			e2.setAttribute('onclick','fx(1)');
			e2.setAttribute('title','FX ON');
			e2.setAttribute('src','styles/button_speaker_off.png');
		}
	}