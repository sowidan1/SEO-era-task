<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Report</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f7fa; padding: 20px; margin: 0;">
<div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

    <!-- Header -->
    <div style="background: #4F46E5; padding: 20px; text-align: center; color: white;">
        <h1 style="margin: 0; font-size: 24px;">📊 Daily Report</h1>
        <p style="margin: 5px 0 0; font-size: 14px;">{{ now()->format('F j, Y') }}</p>
    </div>

    <!-- New Posts -->
    <div style="padding: 20px;">
        <h2 style="color: #4F46E5; margin-bottom: 10px;">📝 New Posts Today: {{ $newPosts->count() }}</h2>
        @if($newPosts->count() > 0)
            <ul style="padding-left: 20px; margin: 0;">
                @foreach($newPosts as $post)
                    <li style="margin-bottom: 5px; font-size: 14px;">
                        <strong>{{ $post->title }}</strong>
                        <span style="color: #6b7280;">({{ $post->created_at->format('H:i') }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p style="color: #6b7280; font-size: 14px;">No new posts today.</p>
        @endif
    </div>

    <!-- New Users -->
    <div style="padding: 20px; border-top: 1px solid #e5e7eb;">
        <h2 style="color: #4F46E5; margin-bottom: 10px;">👤 New Users Today: {{ $newUsers->count() }}</h2>
        @if($newUsers->count() > 0)
            <ul style="padding-left: 20px; margin: 0;">
                @foreach($newUsers as $user)
                    <li style="margin-bottom: 5px; font-size: 14px;">
                        <strong>{{ $user->name }}</strong>
                        <span style="color: #6b7280;">({{ $user->created_at->format('H:i') }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p style="color: #6b7280; font-size: 14px;">No new users today.</p>
        @endif
    </div>

    <!-- Footer -->
    <div style="background: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af;">
        This is an automated report sent by your Laravel application.
    </div>
</div>
</body>
</html>
