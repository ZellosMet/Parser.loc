<div class="d-flex flex-column flex-shrink-0 text-black" >       
  <h4 class="px-3">My Documents</h4> 
  <form method="POST">
    <?foreach ($documents as $document) : ?>   
      <div class="d-flex flex-column form-group">
        <input type="submit" class="btn btn-light btn-primary btn-sm active mb-1" name="<?= $document["Document_id"] ?>" value="<?=$document["Document_title"] ?>" >            
      </div>
      <? endforeach; ?>    
    </form> 
</div>