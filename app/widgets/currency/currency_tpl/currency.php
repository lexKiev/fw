<!-- Currency widget -->
<option value="" class="label"><?= $this->currency['code']; ?></option>
<?php foreach ($this->currencies as $currencyKey => $currencyValue): ?>
	<?php if ($currencyKey != $this->currency['code']): ?>
        <option value="<?= $currencyKey ?>"><?= $currencyKey ?></option>
	<?php endif; ?>
<?php endforeach; ?>