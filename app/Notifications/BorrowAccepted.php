<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Borrow;

class BorrowAccepted extends Notification
{
    use Queueable;

    /**
     * The borrow instance.
     *
     * @var \App\Models\Borrow
     */
    protected $borrow;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Borrow $borrow
     */
    public function __construct(Borrow $borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $bookTitle = $this->borrow->book->title;
        $returnDate = $this->borrow->return_date;

        return (new MailMessage)
            ->line("Your borrow request for the book '{$bookTitle}' has been accepted.")
            ->line("Return Date: {$returnDate}")
            ->action('View Book Details', url('/books/' . $this->borrow->book->id))
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
            'message' => "Your borrow request for the book '{$this->borrow->book->title}' has been accepted.",
            'book_title' => $this->borrow->book->title,
            'return_date' => $this->borrow->return_date,
        ];
    }

}
