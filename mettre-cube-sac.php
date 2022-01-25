<div class="modal" id="mettre-cube-sac">
    <div class="overlay"></div>
    <div class="content">
    	<h1>Mettre un ou plusieurs cube dans le sac</h1>
        <form action="action-mettre-cube-sac.php" method="post">
		<div>
	        <label for="cube-violet">Cubes violets</label>
	        <input type="number" id="cube-violet" name="cube-violet" value="0" required />
	    </div>
	    <div>
	        <label for="cube-blanc">Cubes blancs</label>
	        <input type="number" id="cube-blanc" name="cube-blanc" value="0" required />
	    </div>
	    <button type="submit">Valider</button>
	</form>
   	</div>
</div>