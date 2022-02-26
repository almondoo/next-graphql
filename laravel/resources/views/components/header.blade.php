<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? '' }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('/images/laravel-logo.png') }}">
</head>

<body>
  <header class="header">
    <a class="logo" href="/home">
      <img class="img" src="{{ asset('/images/logo.png') }}" />
    </a>
    <ul class="list">
      <li>
        <a href="/home">Home</a>
      </li>
      <li>
        <a href="https://github.com/tsubasa111/laravel-9version" target="_blank" rel="nooperner noreferrer">
          Github
        </a>
      </li>
      <li>
        <div class="dropdown">
          <button>Fake</button>

          <div class="dropdown__content">
            <ul class="menu-list">
              <li>fake</li>
              <li>faker</li>
              <li>fakest</li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
    <div class="is--sp dropdown__wrap is-full">
      <div class="dropdown">
        <button>リンク</button>
        <div class="dropdown__content">
          <ul class="menu-list">
            <li>
              <a href="/home">Home</a>
            </li>
            <li>
              <a href="https://github.com/tsubasa111/laravel-9version" target="_blank"
                rel="nooperner noreferrer">Github</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    @auth
      <div class="button-group right">
        <button class="button is--white--space"><a href="{{ route('user.logout') }}">ログアウト</a></button>
      </div>
    @endauth
  </header>
  <div class="header-spacer"></div>
  <div class="out-inner">
