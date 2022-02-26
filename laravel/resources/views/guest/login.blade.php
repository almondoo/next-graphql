<x-header title="ログインページ" />
<div class="login-page">
  <div class="card">
    <div class="card-content">
      <div class="title">
        <h1>ログイン</h1>
      </div>
      <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <div class="form__list">
          <div class="field">
            <input placeholder="メールアドレス" type="email" name="email" class="field__input" value="{{ old('email') }}" />
            <label class="field__label">メールアドレス</label>
          </div>
          @error('email')
            <x-error-text message="{{ $message }}" />
          @enderror
        </div>

        <div class="form__list">
          <div class="field">
            <input placeholder="パスワード" type="password" name="password" class="field__input" />
            <label class="field__label">パスワード</label>
          </div>
          @error('password')
            <x-error-text message="{{ $message }}" />
          @enderror
          @error('login')
            <x-error-text message="{{ $message }}" />
          @enderror
        </div>

        <div class="form__list">
          <label>
            <input type="checkbox" name="is_remember" {{ old('is_remember') ? 'checked' : '' }}>
            ログイン情報を保存する
          </label>
          @error('is_remember')
            <x-error-text message="{{ $message }}" />
          @enderror
        </div>

        <input class="button contained is-full text-align__center mt-2" type="submit" value="ログイン" />
      </form>
      <div class="button-group mt-2 right">
        <a href="{{ route('register') }}"><button class="button">アカウント作成</button></a>
      </div>
    </div>
  </div>
</div>
<x-footer />
