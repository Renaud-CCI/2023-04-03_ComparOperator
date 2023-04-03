<form action="./booking.php" method="get">

<label for="location-select">Choisir une destination : </label>

<select name="location" id="location-select" required>
  <?php foreach ($allLocations as $location): ?>
    <option value="<?=$location?>"><?=$location?></option>
  <?php endforeach; ?>
</select>

<button type="submit">Valider</button>

</form>