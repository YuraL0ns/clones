
                {{--<div class="row">--}}
                    {{--<div class="col-6">--}}
                        {{--<div class="card card-secondary">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">Add Files</h3>--}}
                            {{--</div>--}}
                            {{--<div class="card-body project-files">--}}
                                {{--<div class="form-group file-input row">--}}
                                    {{--<div class="form-group col-6">--}}
                                        {{--<label for="project-add-file-admin">Upload File</label>--}}
                                        {{--<input type="file" id="project-add-file-admin" class="form-control" name="files[]">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-6">--}}
                                        {{--<label for="file-type-admin">File Type</label>--}}
                                        {{--<select id="file-type-admin" class="form-control" name="file_types[]">--}}
                                            {{--<option value="drawing">Чертеж</option>--}}
                                            {{--<option value="report">отчет</option>--}}
                                            {{--<option value="document">Документ</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card-footer">--}}
                                {{--<button type="button" class="btn btn-warning add-file-btn"><i class="fas fa-plus-circle"></i></button>--}}
                            {{--</div>--}}
                            {{--<!-- /.card-body -->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-6">--}}
                        {{--<div class="card card-secondary">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">Выбирать Продукты</h3>--}}
                            {{--</div>--}}
                            {{--<div class="card-body">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Детали</label>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-details-name-admin">наименование</label>--}}
                                        {{--<select id="project-details-name-admin" class="form-control" name="safe_detail">--}}
                                            {{--<option value="" selected>-- Please Select --</option>--}}
                                            {{--@foreach($safeDetails as $detail)--}}
                                                {{--<option value="{{ $detail->id }}">{{ $detail->name . ' (' . $detail->in . ' штук)' }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-details-count-admin">кол-во</label>--}}
                                        {{--<input type="number" name="safe_detail_count" id="project-details-count-admin" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Расходные материалы</label>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-materials-name-admin">наименование</label>--}}
                                        {{--<select id="project-materials-name-admin" class="form-control" name="safe_material">--}}
                                            {{--<option value="" selected>-- Please Select --</option>--}}
                                            {{--@foreach($safeMaterials as $material)--}}
                                                {{--<option value="{{ $material->id }}">{{ $material->name . ' (' . $material->in . ' штук)' }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-materials-count-admin">кол-во</label>--}}
                                        {{--<input type="number" name="safe_material_count" id="project-materials-count-admin" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Покупные</label>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-purchased-name-admin">наименование</label>--}}
                                        {{--<select id="project-purchased-name-admin" class="form-control" name="safe_purchased">--}}
                                            {{--<option value="" selected>-- Please Select --</option>--}}
                                            {{--@foreach($safePurchased as $purchased)--}}
                                                {{--<option value="{{ $purchased->id }}">{{ $purchased->name . ' (' . $purchased->in . ' штук)' }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="project-purchased-count-admin">кол-во</label>--}}
                                        {{--<input type="number" name="safe_purchased_count" id="project-purchased-count-admin" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.card-body -->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-6">--}}
                        {{--<div class="card card-secondary">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">Добавить Продукт И Использовать</h3>--}}
                            {{--</div>--}}
                            {{--<div class="card-body">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="project-new-safe-name-admin">Имя</label>--}}
                                    {{--<input type="text" name="new_safe_name" id="project-new-safe-name-admin" class="form-control">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="project-new-safe-type-admin">Тип Продукта</label>--}}
                                    {{--<select id="project-new-safe-type-admin" class="form-control" name="new_safe_type">--}}
                                        {{--<option selected value="">-- Please Select --</option>--}}
                                        {{--<option value="detail">Деталь</option>--}}
                                        {{--<option value="material">материал</option>--}}
                                        {{--<option value="purchased">покупный</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="project-new-safe-count-admin">кол-во</label>--}}
                                    {{--<input type="number" name="new_safe_count" id="project-new-safe-count-admin" class="form-control">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="project-new-safe-use-admin">зарезервировать</label>--}}
                                    {{--<input type="number" name="new_safe_use" id="project-new-safe-use-admin" class="form-control">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}