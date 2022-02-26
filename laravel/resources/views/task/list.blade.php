<x-header title="タスク詳細ページ" />
<div class="task__list--page">
  <div class="top__content mb-3">
    <h1>タスク一覧</h1>
  </div>
  @isset($status)
    <x-alert type="success">
      タスクを削除しました。
    </x-alert>
  @endisset
  <form method="GET" action="{{ route('task.list') }}">
    <div class="form__list mb-1">
      <div class="field">
        <input placeholder="タイトル検索" type="text" name="keyword" class="field__input" value="{{ $keyword ?? '' }}" />
        <label class="field__label">タイトル検索</label>
      </div>
      @error('keyword')
        <x-error-text message="{{ $message }}" />
      @enderror
    </div>

    <div class="button-group right">
      <input class="button contained" type="submit" value="検索" />
    </div>
  </form>

  <div class="button-group mt-3 right">
    <a href="{{ route('task.detail') }}"><button class="button contained bgc--secondary">タスク追加</button></a>
  </div>
  @isset($tasks)
    <div class="table__wrap">
      <table class="table mt-1">
        <thead>
          <tr>
            <th class="text--middle">ID</th>
            <th class="text--middle">タイトル</th>
            <th class="text--middle">テキスト</th>
            <th class="text--middle user--name">作成者</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tasks as $task)
            <tr>
              <td class="text--middle">
                <a href="{{ route('task.detail', ['task' => $task->id]) }}">{{ $task->id }}</a>
              </td>
              <td>{{ $task->title }}</td>
              <td>{{ $task->text }}</td>
              <td class="text--middle">{{ $task->user->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @php
      if (!empty($keyword)) {
          $tasks->appends(['keyword' => $keyword]);
      }
    @endphp
    {{ $tasks->links('components.pagination') }}
  @endisset
</div>
<x-footer />
