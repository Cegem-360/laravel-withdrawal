<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Filament\Resources;

use Cegem360\Withdrawal\Enums\DeclarationType;
use Cegem360\Withdrawal\Filament\Resources\Pages\ListWithdrawalDeclarations;
use Cegem360\Withdrawal\Filament\Resources\Pages\ViewWithdrawalDeclaration;
use Cegem360\Withdrawal\Models\WithdrawalDeclaration;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class WithdrawalDeclarationResource extends Resource
{
    protected static ?string $model = WithdrawalDeclaration::class;

    protected static string|UnitEnum|null $navigationGroup = 'Jog';

    protected static ?string $navigationLabel = 'Elállási nyilatkozatok';

    protected static ?string $modelLabel = 'elállási nyilatkozat';

    protected static ?string $pluralModelLabel = 'elállási nyilatkozatok';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Típus')
                    ->formatStateUsing(fn ($state): string => $state instanceof DeclarationType ? $state->label() : (string) $state),
                TextColumn::make('consumer_name')->label('Fogyasztó')->searchable(),
                TextColumn::make('consumer_email')->label('E-mail')->searchable(),
                TextColumn::make('subject')->label('Tárgy')->limit(40),
                TextColumn::make('contract_date')->label('Szerződés dátuma')->date(),
                TextColumn::make('submitted_at')->label('Beküldve')->dateTime(),
            ])
            ->defaultSort('submitted_at', 'desc');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('type')
                ->label('Típus')
                ->formatStateUsing(fn ($state): string => $state instanceof DeclarationType ? $state->label() : (string) $state),
            TextEntry::make('consumer_name')->label('Fogyasztó neve'),
            TextEntry::make('consumer_email')->label('E-mail'),
            TextEntry::make('consumer_address')->label('Cím')->columnSpanFull(),
            TextEntry::make('subject')->label('Termék/szolgáltatás megnevezése')->columnSpanFull(),
            TextEntry::make('contract_date')->label('Szerződés / átvétel dátuma')->date(),
            TextEntry::make('order_reference')->label('Rendelési azonosító')->placeholder('—'),
            TextEntry::make('message')->label('Megjegyzés')->columnSpanFull()->placeholder('—'),
            TextEntry::make('submitted_at')->label('Beküldve')->dateTime(),
        ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWithdrawalDeclarations::route('/'),
            'view' => ViewWithdrawalDeclaration::route('/{record}'),
        ];
    }
}
