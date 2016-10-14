user.id {{ $user['id']  }}<br />
user.name {{ $user['name']  }}<br />

{{ csrf_field()  }}

<br />

url: {{ route('hehe', ['postId' => 1, 'commentId' => 2]) }}