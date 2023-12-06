<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Book;

class BookBorrowed extends Notification
{
    use Queueable;

    /**
     * The book instance.
     *
     * @var \App\Models\Book
     */
    public $book;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $bookTitle = $this->book->title;

        return (new MailMessage)
            ->line("A Student Requested a Book: $bookTitle.")
            ->action('View Book Details', route('books.show', $this->book->id))
            ->line('Remember to return the book by the specified return date.')
            ->line('Thank you for using our library!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'book_id' => $this->book->id,
            'book_title' => $this->book->title,
            'notification_type' => 'book_borrowed',
        ];
    }
}
