<p class="mt-lg-5 mt-3"><strong>Newsletters</strong></p>
<hr>
<p>Abonnez vous à notre newsletter pour recevoir une notification à chaque nouvelle publication</p>
<form method="post" action="<?= $this->entity()->blogs('newsletters'); ?>">

    <?= $form->input('newsletterEmail', '', 'Saisissez votre email', [
        'required' => 'required',
        'type' => 'email',
    ]) ?>

    <?= $form->input('newsletters', '', 'Envoyer', [
        'type' => 'submit',
        'class' => 'btn btn-perso-primary',
    ]) ?>
</form>