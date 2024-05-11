function getById(id) {
	a = document.getElementById(id);
	if (a) {
		return a;
	}
	return null;
}
surbrillance = '';
function surbrillance(id) {
	if (surbrillance != '') {
		getById(`ligne_${surbrillance}`).style.background = 'transparent';
	}
	getById('ligne_' + id).style.background = '#ddd';
	surbrillance = id;
}
function affiche(id) {
	a = document.getElementById(id);
	if (a) {
		if (a.style.display == 'none') {
			a.style.display = 'block';
		} else {
			a.style.display = 'none';
		}
	}
}
