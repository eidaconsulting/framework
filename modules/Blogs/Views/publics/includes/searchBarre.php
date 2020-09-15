<form method="post" action="<?= $this->entity()->blogs('search'); ?>">
    <div class="input-group">
        <input type="text" name="blogQuery" placeholder="Rechercher" class="form-control" >
        <button type="submit" name="search-blog" class="btn btn-perso-primary input-group-append"><i class="fa fa-search"></i> </button>
    </div>
</form>