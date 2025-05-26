import { toast } from '@/components/ui/toast';
import { Config } from '@/types';
import { clsx, type ClassValue } from 'clsx';
import moment from 'moment';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function showToast(flash: any) {
    if (flash.success) {
        toast({
            title: 'Selamat.',
            description: flash.success,
            variant: 'success',
        });
    }

    if (flash.warning) {
        toast({
            title: 'Perhatian.',
            description: flash.warning,
            variant: 'warning',
        });
    }

    if (flash.error) {
        toast({
            title: 'Ooops.',
            description: flash.error,
            variant: 'destructive',
        });
    }
}

export function dateFormat(date: string, format = 'D MMM YYYY, HH:mm a', region = 'id') {
    moment.locale(region);

    return moment(date).format(format);
}

export function findConfig(key: string, configs: Config[]) {
    return configs.find((config) => config.key === key)?.value;
}
