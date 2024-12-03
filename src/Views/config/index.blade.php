@extends('lzadmin.layouts.app')
@section('title', '')
@section('styles')
@endsection

@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md6">
                <div class="layui-card">
                    <div class="layui-card-header">{{$model['title']}}【{{$model['index_key']}}】</div>
                    <div class="layui-card-body">
                        <form class="layui-form">
                            @foreach($form as $html)
                                {!! $html !!}
                            @endforeach
                            @if($auth)
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="submit">确认保存</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use(function () {
            var form = layui.form;
            // 表单提交
            form.on('submit(submit)', function (data) {
                let field = data.field;
                com.post("/sys/config/update/{{$model['index_key']}}", field, function (res) {
                    if (res.code) {
                        layer.msg(res.msg, {icon: 2})
                    } else {
                        layer.msg(res.msg, {icon: 1})
                    }
                });
                return false;
            });
        })
    </script>
@endsection
