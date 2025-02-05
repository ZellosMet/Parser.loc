<?require_once COMPONENTS."/header.php"?>
      
      <main class="main" style="box-sizing: border-box">
        <div class="row" style="--bs-gutter-x: 0;"> 
            <div class="col-5 py-3 px-3" style="border: 1px solid gray; border-radius: 10px;">   
                <p>Markdown</p>
                <form method="POST">
                <div class="form-group mb-3">
                    <label for="title">Title:</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Title" onkeyup="Parser(this.value, this.name)" value = "<?= $load_title?>">
                </div>
                <div class="form-group mb-3">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" class="form-control" placeholder="Content" rows="15" onkeyup="Parser(this.value, this.name)"><?=$load_content ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                <button type="submit" class="btn btn-primary" name="btn_clear">Clear</button>
                <button type="submit" class="btn btn-primary" name="btn_del" onclick="return confirm('Delete document?')"> <img src="public/assets/img/trash-can.ico" alt="img" style="height: 20px"> </button>
                </form>
            </div>
            <div class="col-5 py-3 px-3 mx-1" style="border: 1px solid gray; border-radius: 10px;"> 
                <p>Html</p>
                <span id="htmltext_title"><?=$parser_load_title?></span>
                <span id="htmltext_content"><?=$parser_load_content?></span>
            </div>
            <div class="col py-3 px-3" style="border: 1px solid gray; border-radius: 10px;">
                <?require_once COMPONENTS."/sidebar.php"?>
            </div>  
        </div>                
    </main>  
       
<?require_once COMPONENTS."/footer.php"?>
    
 