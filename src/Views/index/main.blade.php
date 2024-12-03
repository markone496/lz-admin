@extends('lzadmin.layouts.app')
@section('title', '')
@section('styles')
@endsection
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            @if(isAuth(86))
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            用户数
                            <i class="layui-inline layui-icon layui-icon-user"></i>
                        </div>
                        <div class="layui-card-body layuiadmin-card-list">
                            <p class="layuiadmin-big-font">
                                {{$user_total}}
                                <span class="layuiadmin-span-color">总数</span>
                            </p>
                            <p>
                                {{$user_today}}
                                <span class="layuiadmin-span-color">今日数</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isAuth(87))
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            算力体验卷
                            <i class="layui-inline layui-icon layui-icon-form"></i>
                        </div>
                        <div class="layui-card-body layuiadmin-card-list">
                            <p class="layuiadmin-big-font">
                                {{$sl_exp_total}}
                                <span class="layuiadmin-span-color">总数</span>
                            </p>
                            <p>
                                {{$sl_exp_today}}
                                <span class="layuiadmin-span-color">今日数</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

@endsection
