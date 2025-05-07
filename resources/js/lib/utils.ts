import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { toast } from '@/components/ui/toast';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function showToast(flash: any) {
    if (flash.success) {
        toast({
            title: 'Selamat.',
            description: flash.success,
        });
    } else {
        toast({
            title: 'Ooops.',
            description: flash.error,
            variant: 'destructive'
        });
    }
}
