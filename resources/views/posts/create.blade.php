<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Post | {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-slate-100 text-gray-900 antialiased">
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-8">
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                Back to posts
            </a>

            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">Create Post</h1>
            <p class="mt-2 text-sm text-slate-600">
                Add a new post with a clear title and a readable body.
            </p>
        </header>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            @if (session('success'))
                <div id="success-alert" class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form action="{{ route('post.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-slate-700">
                        Title
                    </label>
                    <input type="text" id="title" name="title" required placeholder="Enter post title"
                        value="{{ old('title') }}"
                        class="w-full rounded-xl border bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:ring-2 {{ $errors->has('title') ? 'border-red-500 focus:border-red-500 focus:ring-red-100' : 'border-slate-300 focus:border-slate-900 focus:ring-slate-200' }}">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="mb-2 block text-sm font-medium text-slate-700">
                        Body
                    </label>
                    <textarea id="body" name="body" rows="9" placeholder="Write your post content here..." required
                        class="w-full rounded-xl border bg-white px-4 py-3 text-sm leading-7 text-slate-900 outline-none transition focus:ring-2 {{ $errors->has('body') ? 'border-red-500 focus:border-red-500 focus:ring-red-100' : 'border-slate-300 focus:border-slate-900 focus:ring-slate-200' }}">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                        Publish Post
                    </button>

                    <a href="{{ route('home') }}"
                        class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
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
