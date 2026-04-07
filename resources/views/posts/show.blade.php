<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $post_details->title }} | {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-slate-100 text-gray-900 antialiased">
    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-8">
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                Back to posts
            </a>
        </header>

        <main class="space-y-8">
            @if (session('success'))
                <div id="success-alert" class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-5 flex flex-col gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500">Post #{{ $post_details->id }}</p>
                        <p class="text-sm text-slate-500">{{ $post_details->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('post.edit', $post_details->id) }}"
                            class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800">
                            Edit
                        </a>

                        <form action="{{ route('post.destroy', $post_details->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">
                    {{ $post_details->title }}
                </h1>

                <div class="mt-5">
                    <p class="whitespace-pre-line text-base leading-8 text-slate-700">
                        {{ $post_details->body }}
                    </p>
                </div>
            </article>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="flex flex-col gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold tracking-tight text-slate-900">Comments</h2>
                        <p class="mt-1 text-sm text-slate-600">
                            {{ $post_details->comments->count() }}
                            {{ $post_details->comments->count() === 1 ? 'comment' : 'comments' }}
                        </p>
                    </div>

                    <details class="group" {{ $errors->has('author') || $errors->has('body') ? 'open' : '' }}>
                        <summary
                            class="cursor-pointer list-none rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                            Add Comment
                        </summary>

                        <div class="mt-4 w-full rounded-xl border border-slate-200 bg-slate-50 p-4 sm:w-105">
                            <form action="{{ route('post.comment') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label for="author" class="mb-2 block text-sm font-medium text-slate-700">
                                        Author
                                    </label>
                                    <input type="text" id="author" name="author" placeholder="Your name"
                                        value="{{ old('author') }}"
                                        class="w-full rounded-xl border bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:ring-2 {{ $errors->has('author') ? 'border-red-500 focus:border-red-500 focus:ring-red-100' : 'border-slate-300 focus:border-slate-900 focus:ring-slate-200' }}">
                                    @error('author')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="body" class="mb-2 block text-sm font-medium text-slate-700">
                                        Comment
                                    </label>
                                    <textarea id="body" name="body" rows="4" placeholder="Write your comment here..."
                                        class="w-full rounded-xl border bg-white px-4 py-3 text-sm leading-7 text-slate-900 outline-none transition focus:ring-2 {{ $errors->has('body') ? 'border-red-500 focus:border-red-500 focus:ring-red-100' : 'border-slate-300 focus:border-slate-900 focus:ring-slate-200' }}">{{ old('body') }}</textarea>
                                    @error('body')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="post_id" value="{{ $post_details->id }}">

                                <div class="flex items-center gap-3">
                                    <button type="submit"
                                        class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                                        Publish Comment
                                    </button>

                                    <button type="reset"
                                        class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-white">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </details>
                </div>

                <div class="mt-6 space-y-4">
                    @forelse ($post_details->comments as $comment)
                        <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900">
                                        {{ $comment->author }}
                                    </h3>
                                    <span class="mt-1 block text-xs text-slate-500">
                                        {{ $comment->created_at?->format('M d, Y h:i A') }}
                                    </span>
                                </div>

                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-50">
                                        Delete
                                    </button>
                                </form>
                            </div>

                            <p class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-700">
                                {{ $comment->body }}
                            </p>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                            <h3 class="text-lg font-semibold text-slate-900">No comments yet</h3>
                            <p class="mt-2 text-sm text-slate-600">Be the first to leave a comment on this post.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
    <script>
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
