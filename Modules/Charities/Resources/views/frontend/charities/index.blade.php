@extends('apps::frontend.layouts.app')
@section('title', '')
@push('styles')
    <style>
        .form-row-wide {
            margin-bottom: 13px;
        }

        form #submit {
            width: 262px;
            height: 48px;
            border-radius: 24px;
        }

        .nice-select {
            margin-bottom: 0px !important;
        }
    </style>
@endpush
@section('content')
    @include('apps::frontend.layouts.page-banner',['title' => 'طلب استلام عيني' ,'background' => asset('frontend/images/donate-resource.png')])

    <div class="inner-page">
        <div class="container">
            <h2 class="title-page">الانضمام كشريك نجاح</h2>
            <div class="row">
                <div class="col-md-7">
                    <ul class="list-dots list-items">
                        <li>    تحديد الأسس والمبادئ الأخلًقية للممارسات المهنية في إطار المشروع</li>
                        <li> توجيه سلوك العاملين تحت مظلة المشروع</li>
                        <li>تحفيز العاملين في المشروع للًلتزام بالخلق القويم، والتعاون على تطبيقه</li>
                        <li>تعزيز الممارسات الإيجابية تحت ظل المشروع، وتحسين أو تصحيح ما عداها </li>
                        <li> ترسيخ حضور الأخلًق في ثقافة العاملين تحت مظلة المشروع</li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="الاسم للتواصل"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder=" اسم الجمعية"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="البريد الالكتروني"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="رقم الهاتف"/>
                        </div>
                        <div class="form-group">
                            <p>من خلال التسجيل تكون قد وافقت على <a href="index.php?page=methak">ميثاق المشروع</a></p>
                        </div>
                        <button type="submit" class="btn theme-btn btn-block">طلب انضمام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        function addItem() {
            var rand = Math.floor(Math.random() * 9000000000) + 1000000000;
            var html = replaceAll($('#form_ex').html(), ':rand', rand);
            $('#form_content').append(html);
        }


        // DELETE member BUTTON
        $("#form_content").on("click", ".trash-btn", function (e) {
            e.preventDefault();
            $(this).closest('.single_item').remove();
        });
    </script>
@endpush
