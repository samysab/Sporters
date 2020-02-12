
let a = 0;
function showResBox() {
	if (!a) {
		document.getElementById('searchResBox').style.display = "block";
		a = 1;
	}
}


function search(e) {

	let value = e.value;

	if (value.length > 1) {

		let xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let res = JSON.parse(this.responseText);

				let usersTab = res[0];
				let gamesTab = res[1];
				let productsTab = res[2];
				let fieldsTab = res[3];


				function searchLoad(category, tab, colId, colName, editpage) {

					document.getElementById(category).innerHTML = "";

					for (let i = 0; i < tab.length; i++) {
						if (category == 'ProductsRow') {
							document.getElementById(category).innerHTML += '<li class="list-group-item resid" data-resid="'+tab[i][colId]+'"><a href="../admin/'+editpage+'.php?modifier='+tab[i][colName]+'">' + tab[i][colName] + '</a></li>';
						} else {
							document.getElementById(category).innerHTML += '<li class="list-group-item resid" data-resid="'+tab[i][colId]+'"><a href="../admin/'+editpage+'.php?modifier='+tab[i][colId]+'">' + tab[i][colName] + '</a></li>';
						}
					}
				}

				searchLoad('UsersRow', usersTab, 'userId', 'pseudo', 'modifUser');
				searchLoad('GamesRow', gamesTab, 'gameId', 'gameName', 'modifGame');
				searchLoad('ProductsRow', productsTab, 'productID', 'productName', 'shop_list');
				searchLoad('FieldsRow', fieldsTab, 'fieldId', 'fieldName', 'viewFields');

			}
		};

		xhttp.open('GET', 'mirrors/search.php?search='+value, true);
		xhttp.send();

	}

}


// let searchInput = document.getElementById('searchInput');
// searchInput.addEventListener('onkeypress', search(this));
