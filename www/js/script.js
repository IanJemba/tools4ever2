window.onload = function() {
	var fonts = ["Montez","Lobster","Josefin Sans","Shadows Into Light","Pacifico","Amatic SC", "Orbitron", "Rokkitt","Righteous","Dancing Script","Bangers","Chewy","Sigmar One","Architects Daughter","Abril Fatface","Covered By Your Grace","Kaushan Script","Gloria Hallelujah","Satisfy","Lobster Two","Comfortaa","Cinzel","Courgette"];
	var string = "";
	var select = document.getElementById("select");
	var sql = document.getElementById('sql-statement');
	
	
	if(select != null){
		
		for(var a = 0; a < fonts.length ; a++){
			var opt = document.createElement('option');
			opt.value = opt.innerHTML = fonts[a];
			opt.style.fontFamily = fonts[a];
			select.add(opt);
		}
	}

	if(sql != null){
				// Highlight capital letters in red
		sql.innerHTML = sql.textContent.replace(/\b([A-Z]+)\b/g, '<span class="highlight">$1</span>');

		// Highlight the table name in blue
		sql.innerHTML = sql.innerHTML.replace(/(FROM\s+\w+)/i, function(match, p1) {
			var parts = p1.split(' ');
			console.log(parts);
			return parts[0] + ' <span id="highlight-table">' + parts[1] + '</span>';
		});

		// sql.innerHTML = sql.textContent.replace(/(FROM\s+\w+)/i, function(match, p1) {
		// 	var parts = p1.split(' ');
		// 	return parts[0] + ' <span class="highlight-table">' + parts[1] + '</span>';
		// });

		
	}
}