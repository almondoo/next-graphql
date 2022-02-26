<x-header title="ユーザー作成" />
<div class="register-page">
  <div class="card">
    <div class="card-content">
      <div class="title">
        <h1>アカウント作成</h1>
      </div>
      <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <div class="form__list">
          <div class="field">
            <input placeholder="名前" type="text" name="name" class="field__input" value="{{ old('name') }}" />
            <label class="field__label">名前</label>
          </div>
          @error('name')
            <x-error-text message="{{ $message }}" />
          @enderror
        </div>

        <div class="form__list">
          <div class="field">
            <input placeholder="メールアドレス" type="email" name="email" class="field__input"
              value="{{ old('email') }}" />
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
        </div>

        <div class="form__list">
          <div class="field">
            <input placeholder="パスワード再確認" type="password" name="password_confirmation" class="field__input" />
            <label class="field__label">パスワード確認</label>
          </div>
          @error('password_confirmation')
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

        <input class="button contained is-full text-align__center mt-2" type="submit" value="作成" />
      </form>
      <div class="button-group mt-2 right">
        <a href="{{ route('login') }}"><button class="button">アカウントをお持ちの方</button></a>
      </div>
    </div>
  </div>
</div>
<x-footer />
