<x-header title="タスク詳細ページ" />
@php
$has_task = !empty($task);
@endphp
<div class="top__content mb-3">
  <h1>{{ $has_task ? 'タスク修正' : 'タスク作成' }}</h1>
</div>

@isset($status)
  <x-alert type="success">
    @switch($status)
      @case('create')
        タスク作成しました。
      @break

      @case('update')
        タスクを更新しました。
      @break
    @endswitch
  </x-alert>
@endisset
<form method="POST" action="{{ $has_task ? route('task.update', ['task' => $task->id]) : route('task.create') }}">
  @csrf
  @if ($has_task)
    @method('PUT')
  @endif
  @if ($has_task)
    <input type="hidden" name="id" value="{{ $task->id }}" />
  @endif

  <div class="form__list">
    <div class="field">
      <input placeholder="タイトル" type="text" name="title" class="field__input"
        value="{{ $task->title ?? old('title') }}" />
      <label class="field__label">タイトル</label>
    </div>
    @error('title')
      <x-error-text message="{{ $message }}" />
    @enderror
  </div>

  <div class="form__list">
    <div class="field">
      <textarea placeholder="内容" type="textarea" name="text" class="field__input"
        rows="8">{{ $task->text ?? old('text') }}</textarea>
      <label class="field__label">内容</label>
    </div>
    @error('text')
      <x-error-text message="{{ $message }}" />
    @enderror
    @error('task')
      <x-error-text message="{{ $message }}" />
    @enderror
  </div>
  <input id="submit" type="submit" class="is--hidden" />
</form>
@if ($has_task)
  <form method="POST" action="{{ route('task.delete', ['task' => $task->id]) }}">
    @csrf
    @method('delete')
    <input type="hidden" name="id" value="{{ $task->id }}" />
    <input id="delete" type="submit" class="is--hidden" />
  </form>
@endif
<div class="button-group mt-2 right">
  <label class="button contained bgc--danger" for="delete">削除</label>
  <a href="{{ route('task.list') }}"><button class="button">戻る</button></a>
  <label class="button contained" for="submit">{{ $has_task ? '編集' : '作成' }}</label>
</div>
<x-footer />
