
<div class="card">
	<div class="card-header">
		<h4>Nieuwe symptomen</h4>
	</div>

	<div class="card-body">
		<form method="POST" action="/entries/create_symptom">
			{{ csrf_field() }}
			<div>
				<p>
					Maak hier symptomen aan voor uw medisch dagboek. Bijvoorbeeld: koorts, uitslag, hoofdpijn.
				</p>
				<p>
					Heeft u geen nieuwe symptomen? Ga dan verder naar het volgende onderwerp.
				</p>
				<input type="text" name="symptom" placeholder="naam symptom"> 
				<input type="submit" align="center" class="btnSub" value="ok">
			</div>

		</form>
	</div>
</div>
