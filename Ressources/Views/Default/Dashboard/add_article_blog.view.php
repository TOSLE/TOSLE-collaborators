<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ <a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboard_blog"];?>">Blog</a></span> <span class="additional-message-title">/ Add</span></h2>
            </div>
        </section>
    </div>
</div>


<form action="" method="POST">
    <input>
<!-- CKEDITEUR -->
<div id="alerts">
    <noscript>
        <p>
            <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript support, like yours, you should still see the contents (HTML data) and you should be able to edit it normally, without a rich editor interface.
        </p>
    </noscript>
</div>
<!-- <textarea cols="80" class="ckeditor" id="editeur" name="editeur" rows="10"></textarea> -->
<textarea id="textAreaArticle" class="ckeditor" name ="textArea_article" placeholder="Vous n'avez aucune limite de caractère pour votre article." style="margin-bottom: 15px; min-width: 100%; max-width: 100%; min-height: 700px; max-height: 1000px;" class="form-control"></textarea>
<!-- CKEDITEUR -->
    <input class="btn btn-green" value="submit" name="submit" type="submit">
</form>




<!-- CKEDITEUR -->
    <script type="text/javascript" src="<?php echo DIRNAME;?>Public/Libraries/CKEditor/ckeditor.js"></script>
<!-- CKEDITEUR -->