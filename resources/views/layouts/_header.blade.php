<nav class="ui main borderless menu top stackable" id="topnav">
  <div class="ui container">
    <a href="/" class="item secondary">
      网站首页
    </a>
    <a href="{{ route('blog.articles.index') }}" class="item secondary">
      文章专栏
    </a>
    <a href="" class="item secondary">
      关于本站
    </a>

    {{-- 搜索 --}}
    <form id="header-search-app" class="ui fluid category search item secondary" action="{{ route('api.search.index') }}" method="GET">
        <div class="ui icon input">
            <select class="ui compact selection dropdown header-search-left" id="header-search-left">
                <option value="all">所有</option>
                <option selected="" value="articles">文章</option>
            </select>
            <input class="prompt header-search-right" name="q" type="text" placeholder="搜索" autocomplete="off"
              @input="search($event)" v-model="search_val">
            <i class="search icon"></i>
        </div>
        <div class="results transition visible" v-if="search_blog.length" style="display: block !important;">
          <a class="result" v-for="item in search_blog" :href="item.href">
            {{--<div class="image"> 
              <img src="https://iocaffcdn.phphub.org/uploads/avatars/3848_1477641871.png!/both/100x100">    
            </div>--}}
            <div class="content">
              <div class="title" v-text="item.title"></div>
              <div class="description" v-text="item.excerpt"></div>
            </div>
          </a>

          <a href="https://learnku.com/search?q=a" class="action"><i class="icon search"></i>当前列表仅搜加精，更多请搜全站</a></div>
    </form>

    {{-- 右侧导航 --}}
    <div class=" right menu stackable secondary">
      @guest
        <div class="item rm-link-color">
          <a class="mr-4 no-pjax login_required" href="{{ route('login') }}"><i class="icon sign in "></i> 登录 </a>
          <a class="no-pjax" href="{{ route('register') }}" style="margin-left: 10px;"><i class="icon user add "></i> 注册 </a>
        </div>
      @else
        {{-- 添加博文 --}}
        @if(Auth()->user()->hasRole('Founder'))
        <div class="ui simple item dropdown article stackable nav-user-item  secondary" tabindex="0">
          <i class="icon paint brush"></i>  <i class="dropdown icon"></i>
          <div class="ui menu stackable" tabindex="-1">
            <a href="{{ route('blog.articles.create') }}" class="item no-pjax">
              <i class="icon paint brush"></i> 新建博文
            </a>
          </div>
        </div>
        @endif

        {{-- 消息通知 --}}
        <a class="item" href="{{ route('notifications.index') }}" title="消息通知">
                <span class="{{ Auth::user()->notification_count > 0 ? 'red' : 'basic' }} ui circular label notification" id="notification-count">
                    {{ Auth::user()->notification_count }}
                </span>
        </a>

        {{-- 个人中心 --}}
        <div class="ui simple item dropdown article stackable nav-user-item" tabindex="0">
          <img class="ui avatar image lazy" data-original="{{ assert_images(isset( $common['auth']['avatar_path'] ) ? $common['auth']['avatar_path'] : '') }}"> &nbsp;
          {{ $common['auth']['name'] }}
          <i class="dropdown icon"></i>
          <div class="ui menu stackable" tabindex="-1">
            {{-- 是否是站长 --}}
            @if(Auth()->user()->hasRole('Founder'))
            <a href="/horizon" class="item" target="_blank">
              <i class="icon heart"></i> Laravel Horizon
            </a>
            @endif
            <a href="/" class="item">
              <i class="icon heart"></i> 我的收藏
            </a>

            <a href="{{ route('users.show', $common['auth']['id']) }}" class="item">
              <i class="icon user"></i>
              个人中心
            </a>

            <a href="{{ route('users.edit', $common['auth']['id']) }}" class="item">
              <i class="icon settings"></i>
              编辑资料
            </a>

            <a class="item no-pjax" href="javascript:void(0)"
               data-url="{{ route('logout') }}"
               data-method="POST"
               data-prompt="您确定要退出登录吗？"
               title="退出登录" style="cursor: pointer;">
              <i class="icon sign out"></i>
              退出
            </a>
          </div>
        </div>
      @endguest
    </div>
  </div>
</nav>
