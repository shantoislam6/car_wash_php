<?php function yield_head()
{ ?>
   <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css" />
   <style>
      .ck-editor__editable[role="textbox"] {
         /* editing area */
         min-height: 200px;
      }
   </style>

<?php } ?>

<?php view_include("inc/header", $data) ?>

<section class="content-section">
   <div class="container p-5 rounded mt-5">
      <h4 class="text-secondary"> Edit Service</h4>
      <br>
      <?php $service = $data['service'] ?>
      <form action="/services/edit" method="POST" enctype="multipart/form-data">
         <div class="row service-form">

            <input type="hidden" name="edit_id" value="<?= $service['id'] ?>">
            <div class="form-group col-12">

               <label for="title">Title</label>
               <input type="text" name="title" id="title" value="<?= isset($data['form_data']['title']) ? $data['form_data']['title'] : $service['title'] ?>" class="form-control <?= isset($data['errors']['title']) ? 'is-invalid' : '' ?>" placeholder="" aria-describedby="helpId">
               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['title']) ? $data['errors']['title'] : '' ?></span>
               </div>

            </div>

            <div class="form-group col-12">
               <div class="row">
                  <div class="col-sm-6">
                     <label for="cover_img">Cover Image</label>

                     <input onchange="onchangeServiceImage(this.files[0])" type="file" class="form-control-file <?= isset($data['errors']['cover_img']) ? 'is-invalid' : '' ?>" name="cover_img" id="cover_img" placeholder="" aria-describedby="fileHelpId">

                     <script>
                        function onchangeServiceImage(file) {
                           document.getElementById('preview_service_cover_img').src = URL.createObjectURL(file);
                        }
                     </script>

                     <div id="validationServer03Feedback" class="invalid-feedback">
                        <span><?= isset($data['errors']['cover_img']) ? $data['errors']['cover_img'] : '' ?></span>
                     </div>
                     <small class="form-text text-muted">Requirements</small>
                     <small class="form-text text-muted">File type : image/jpg, image/png, image/jpeg </small>
                     <small class="form-text text-muted">File size : Maximum image size 2mb</small>
                  </div>
                  <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">
                     <h6>Preview</h6>
                     <div class="service-input-image">
                        <img id="preview_service_cover_img" src="<?= URLROOT . '/static/service_thumbnails/' . $service['thumbnail_img'] ?>" alt="">
                     </div>
                  </div>
               </div>

            </div>


            <div class="form-group col-12">

               <label for="car_types">Add Car Type</label><br>


               <select hidden id="car_types" name="car_types[]" class="form-control is-invalid" multiple="multiple">

                  <?php foreach ($data['car_types'] as $car_type) : ?>

                     <option <?= isset($data['form_data']['car_types']) ? (in_array($car_type['car_type'], $data['form_data']['car_types']) ? 'selected' : '') : (json_decode($service['car_types']) != NULL ? (in_array($car_type['car_type'], json_decode($service['car_types'])) ? 'selected' : '') : '') ?> value='<?= $car_type['car_type'] ?>'><?= $car_type['car_type'] ?></option>

                  <?php endforeach ?>

               </select>

               <br>
               <input type="hidden" class="form-control <?= isset($data['errors']['car_types']) ? 'is-invalid' : '' ?>">

               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['car_types']) ? $data['errors']['car_types'] : '' ?></span>
               </div>

            </div>

            <div class="form-group col-12">
               <label for="optional_services">Optional Servicese</label><br>

               <!-- Build your select: -->
               <select hidden id="optional_services" name="optional_services[]" class="form-control is-invalid" multiple="multiple">

                  <?php foreach ($data['optional_services'] as $optional_service) : ?>
                     <option <?= isset($data['form_data']['optional_services']) ? (in_array($optional_service['id'], $data['form_data']['optional_services']) ? 'selected' : '') : (json_decode($service['optional_services_id']) != NULL ? (in_array($optional_service['id'], json_decode($service['optional_services_id'])) ? 'selected' : '') : '') ?> value='<?= $optional_service['id'] ?>'><?= $optional_service['title'] ?> ($<?= $optional_service['price'] / 1000?>)</option>
                  <?php endforeach ?>

               </select>
               <br>
               <input type="hidden" class="form-control <?= isset($data['errors']['optional_services']) ? 'is-invalid' : '' ?>">

               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['optional_services']) ? $data['errors']['optional_services'] : '' ?></span>
               </div>

            </div>


            <div class="form-group col-12">
               <label for="description">Description</label>
               <input type="text" name="description" id="description" value="<?= isset($data['form_data']['description']) ? $data['form_data']['description'] : $service['description'] ?>" class="form-control <?= isset($data['errors']['description']) ? 'is-invalid' : '' ?>" placeholder="" aria-describedby="helpId">
               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['description']) ? $data['errors']['description'] : '' ?></span>
               </div>
            </div>

            <div class="form-group col-12">
               <label for="price">Price <small class="muted">(Price in cents)</small></label>
               <input type="text" name="price" id="price" class="form-control <?= isset($data['errors']['price']) ? 'is-invalid' : '' ?>" value="<?= isset($data['form_data']['price']) ? $data['form_data']['price'] : $service['price'] ?>" placeholder="" aria-describedby="helpId">
               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['price']) ? $data['errors']['price'] : '' ?></span>
               </div>
            </div>

            <div class="form-group col-12">
               <label for="body">Body</label>
               <textarea id="editor" class="form-control <?= isset($data['errors']['body']) ? 'is-invalid' : '' ?>" name="body" id="body"><?= isset($data['form_data']['body']) ? $data['form_data']['body'] : $service['body'] ?></textarea>
               <div class="invalid-feedback">
                  <span><?= isset($data['errors']['body']) ? $data['errors']['body'] : '' ?></span>
               </div>
            </div>

         </div>

         <button type="submit" class="btn btn-dark">UPDATE</button>
      </form>
   </div>

</section>

<?php view_include("inc/footer", $data) ?>

<?php function yield_footer()
{ ?>
   <script src="<?php echo URLROOT . '/js/bootstrap-multiselect.min.js' ?>" type="text/javascript"></script>

   <script type="text/javascript">
      $(document).ready(function() {
         $('#car_types').multiselect();
         $('#optional_services').multiselect();
      });
   </script>

   <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>

   <script>
      const config = CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {

         toolbar: {
            items: [
               'exportPDF', 'exportWord', '|',
               'findAndReplace', 'selectAll', '|',
               'heading', '|',
               'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
               'bulletedList', 'numberedList', 'todoList', '|',
               'outdent', 'indent', '|',
               'undo', 'redo',
               '-',
               'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
               'alignment', '|',
               'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
               'specialCharacters', 'horizontalLine', 'pageBreak', '|',
               'textPartLanguage', '|',
               'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
         },
         list: {
            properties: {
               styles: true,
               startIndex: true,
               reversed: true
            }
         },
         heading: {
            options: [{
                  model: 'paragraph',
                  title: 'Paragraph',
                  class: 'ck-heading_paragraph'
               },
               {
                  model: 'heading1',
                  view: 'h1',
                  title: 'Heading 1',
                  class: 'ck-heading_heading1'
               },
               {
                  model: 'heading2',
                  view: 'h2',
                  title: 'Heading 2',
                  class: 'ck-heading_heading2'
               },
               {
                  model: 'heading3',
                  view: 'h3',
                  title: 'Heading 3',
                  class: 'ck-heading_heading3'
               },
               {
                  model: 'heading4',
                  view: 'h4',
                  title: 'Heading 4',
                  class: 'ck-heading_heading4'
               },
               {
                  model: 'heading5',
                  view: 'h5',
                  title: 'Heading 5',
                  class: 'ck-heading_heading5'
               },
               {
                  model: 'heading6',
                  view: 'h6',
                  title: 'Heading 6',
                  class: 'ck-heading_heading6'
               }
            ]
         },

         placeholder: '',
         fontFamily: {
            options: [
               'default',
               'Arial, Helvetica, sans-serif',
               'Courier New, Courier, monospace',
               'Georgia, serif',
               'Lucida Sans Unicode, Lucida Grande, sans-serif',
               'Tahoma, Geneva, sans-serif',
               'Times New Roman, Times, serif',
               'Trebuchet MS, Helvetica, sans-serif',
               'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
         },

         fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
         },
         //
         htmlSupport: {
            allow: [{
               name: /.*/,
               attributes: true,
               classes: true,
               styles: true
            }]
         },

         htmlEmbed: {
            showPreviews: true
         },

         link: {
            decorators: {
               addTargetToExternalLinks: true,
               defaultProtocol: 'https://',
               toggleDownloadable: {
                  mode: 'manual',
                  label: 'Downloadable',
                  attributes: {
                     download: 'file'
                  }
               }
            }
         },

         mention: {
            feeds: [{
               marker: '@',
               feed: [
                  '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                  '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                  '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                  '@sugar', '@sweet', '@topping', '@wafer'
               ],
               minimumCharacters: 1
            }]
         },

         removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',

         ]
      });
   </script>
   </body>

   </html>

<?php } ?>