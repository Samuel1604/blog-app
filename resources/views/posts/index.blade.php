<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Posts | {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-slate-100 text-gray-900 antialiased">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-10 rounded-2xl border border-slate-200 bg-white px-6 py-6 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Simple Blog App</p>
                    <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">All Posts</h1>
                    <p class="mt-2 text-sm text-slate-600">Recent posts and updates from your blog.</p>
                </div>

                <a href="{{ route('post.create') }}"
                    class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                    Create Post
                </a>
            </div>
        </header>

        <main class="space-y-6">
            @if (session('success'))
                <div id="success-alert" class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @forelse ($posts as $post)
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="mb-4 flex items-center justify-between gap-4 border-b border-slate-100 pb-4">
                        <p class="text-sm font-medium text-slate-500">Post #{{ $post->id }}</p>
                        <p class="text-sm text-slate-500">{{ $post->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <h2 class="text-2xl font-semibold tracking-tight text-slate-900">
                        {{ $post->title }}
                    </h2>

                    <p class="mt-3 line-clamp-3 text-base leading-7 text-slate-700">
                        {{ Str::limit($post->body, 200) }}
                    </p>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-sm text-slate-500">{{ $post->comments->count() }} comments</span>
                        <a href="{{ route('post.show', $post->id) }}"
                            class="text-sm font-medium text-slate-900 hover:underline">
                            Read more
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">No posts yet</h2>
                    <p class="mt-2 text-sm text-slate-600">Create your first post to get the blog started.</p>
                </div>
            @endforelse
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
