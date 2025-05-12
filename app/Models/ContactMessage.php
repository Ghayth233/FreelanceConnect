<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'user_id',
        'is_read',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur qui a soumis le message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Marquer le message comme lu.
     *
     * @return bool
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }

    /**
     * Marquer le message comme non lu.
     *
     * @return bool
     */
    public function markAsUnread(): bool
    {
        return $this->update(['is_read' => false]);
    }

    /**
     * Vérifie si le message est marqué comme lu.
     *
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->is_read === true;
    }

    /**
     * Vérifie si le message est marqué comme non lu.
     *
     * @return bool
     */
    public function isUnread(): bool
    {
        return ! $this->isRead();
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Définir l'utilisateur connecté comme créateur du message
        static::creating(function ($message) {
            if (Auth::check()) {
                $message->user_id = Auth::id();
            }
        });
    }
}
