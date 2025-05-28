<script setup lang="ts">
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Image from '@tiptap/extension-image';
import TextAlign from '@tiptap/extension-text-align';
import Underline from '@tiptap/extension-underline';
import StarterKit from '@tiptap/starter-kit';
import { Editor, EditorContent } from '@tiptap/vue-3';
import {
    AlignCenter,
    AlignJustify,
    AlignLeft,
    AlignRight,
    BoldIcon,
    Heading1,
    Heading2,
    Heading3,
    Heading4,
    Heading5,
    Heading6,
    ImageIcon,
    ItalicIcon,
    List,
    ListOrdered,
    Pilcrow,
    Quote,
    UnderlineIcon,
} from 'lucide-vue-next';
import { Separator } from 'reka-ui';
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { Card, CardContent } from './ui/card';
import { ToggleGroup } from './ui/toggle-group';
import ToggleGroupItem from './ui/toggle-group/ToggleGroupItem.vue';

interface Props {
    content?: string;
    isLoading?: boolean;
}
const props = defineProps<Props>();
const emit = defineEmits<{
    (e: 'update:content', value: string): void;
}>();

const editor = ref<Editor>();
const headings = [
    {
        value: '1',
        label: 'Heading 1',
        icon: Heading1,
    },
    {
        value: '2',
        label: 'Heading 2',
        icon: Heading2,
    },
    {
        value: '3',
        label: 'Heading 3',
        icon: Heading3,
    },
    {
        value: '4',
        label: 'Heading 4',
        icon: Heading4,
    },
    {
        value: '5',
        label: 'Heading 5',
        icon: Heading5,
    },
    {
        value: '6',
        label: 'Heading 6',
        icon: Heading6,
    },
];

const addImage = () => {
    const url = window.prompt('URL');

    if (url) {
        editor.value?.chain().focus().setImage({ src: url }).run();
    }
};

onMounted(() => {
    editor.value = new Editor({
        content: props.content || '',
        extensions: [
            StarterKit.configure({
                paragraph: {
                    HTMLAttributes: {
                        class: 'w-full !my-2',
                    },
                },
                heading: {
                    HTMLAttributes: {
                        class: 'w-full !my-2',
                    },
                },
                bulletList: {
                    HTMLAttributes: {
                        class: 'w-full !my-2',
                    },
                },
                orderedList: {
                    HTMLAttributes: {
                        class: 'w-full !my-2',
                    },
                },
                blockquote: {
                    HTMLAttributes: {
                        class: 'w-full !my-2',
                    },
                },
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
                alignments: ['left', 'right', 'center', 'justify'],
                defaultAlignment: 'left',
            }),
            Underline,
            Image.configure({
                allowBase64: true,
            }),
        ],
        editorProps: {
            attributes: {
                class: 'focus:!border-none focus:!outline-none min-h-[100px] max-h-[500px] h-full w-full overflow-auto',
            },
        },
        onUpdate({ editor }) {
            emit('update:content', editor.getHTML());
        },
    });
});

watch(
    () => props.content,
    (newContent) => {
        if (editor.value && newContent !== undefined) {
            editor.value.commands.setContent(newContent, false); // false = no history record
        }
    },
);

onBeforeUnmount(() => {
    editor.value?.destroy();
});
</script>

<template>
    <Card class="relative gap-0 p-0">
        <div v-if="isLoading" class="absolute top-0 left-0 z-30 h-full w-full rounded-lg bg-black opacity-5"></div>
        <div class="flex flex-col items-start space-x-3 py-1 md:flex-row md:items-center">
            <div class="flex items-center space-x-3">
                <ToggleGroup type="multiple">
                    <ToggleGroupItem
                        value="bold"
                        :data-state="editor?.isActive('bold') ? 'active' : 'inactive'"
                        @click="editor?.commands.toggleBold()"
                        ><BoldIcon className="h-4 w-4"
                    /></ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive('italic') ? 'on' : 'off'"
                        value="italic"
                        aria-label="Toggle italic"
                        @click="editor?.commands.toggleItalic()"
                    >
                        <ItalicIcon className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive('underline') ? 'on' : 'off'"
                        value="underline"
                        aria-label="Toggle underline"
                        @click="editor?.chain().focus().setUnderline().run()"
                    >
                        <UnderlineIcon className="h-4 w-4" />
                    </ToggleGroupItem>
                </ToggleGroup>
                <span>|</span>
                <ToggleGroup type="multiple">
                    <ToggleGroupItem
                        :data-state="editor?.isActive({ textAlign: 'left' }) ? 'on' : 'off'"
                        value="align left"
                        aria-label="Toggle align left"
                        @click="editor?.chain().focus().setTextAlign('left').run()"
                    >
                        <AlignLeft className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive({ textAlign: 'center' }) ? 'on' : 'off'"
                        value="align center"
                        aria-label="Toggle align center"
                        @click="editor?.chain().focus().setTextAlign('center').run()"
                    >
                        <AlignCenter className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive({ textAlign: 'right' }) ? 'on' : 'off'"
                        value="align right"
                        aria-label="Toggle align right"
                        @click="editor?.chain().focus().setTextAlign('right').run()"
                    >
                        <AlignRight className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive({ textAlign: 'justify' }) ? 'on' : 'off'"
                        value="align justify"
                        aria-label="Toggle align justify"
                        @click="editor?.chain().focus().setTextAlign('justify').run()"
                    >
                        <AlignJustify className="h-4 w-4" />
                    </ToggleGroupItem>
                </ToggleGroup>
                <span>|</span>
            </div>
            <div class="flex items-center space-x-3">
                <ToggleGroup type="multiple">
                    <ToggleGroupItem
                        :data-state="editor?.isActive('bulletList') ? 'on' : 'off'"
                        value="bulletList"
                        aria-label="Toggle bulletList"
                        @click="editor?.commands.toggleBulletList()"
                    >
                        <List className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive('orderedList') ? 'on' : 'off'"
                        value="orderedList"
                        aria-label="Toggle orderedList"
                        @click="editor?.commands.toggleOrderedList()"
                    >
                        <ListOrdered className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive('blockquote') ? 'on' : 'off'"
                        value="blockquote"
                        aria-label="Toggle blockquote"
                        @click="editor?.commands.toggleBlockquote()"
                    >
                        <Quote className="h-4 w-4" />
                    </ToggleGroupItem>
                </ToggleGroup>
                <span>|</span>
                <Select
                    :value="
                        editor?.isActive('paragraph')
                            ? 'paragraph'
                            : headings.find((h) => editor?.isActive('heading', { level: Number(h.value) }))?.value
                    "
                    @update:model-value="
                        ($e) => ($e == 'paragraph' ? editor?.commands.setParagraph() : editor?.commands.setHeading({ level: Number($e) }))
                    "
                >
                    <SelectTrigger className="max-w-[180px] w-full cursor-pointer flex items-center gap-3" size="sm">
                        <SelectValue placeholder="Select heading" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem value="paragraph">
                                <div class="flex items-center gap-3"><Pilcrow class="h-4 w-4" /> Paragraph</div>
                            </SelectItem>
                            <SelectItem v-for="heading in headings" :value="heading.value" :key="heading.value">
                                <div class="flex items-center gap-3"><component :is="heading.icon" class="h-4 w-4" /> {{ heading.label }}</div>
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <span>|</span>
            </div>
            <div class="flex items-center space-x-3">
                <ToggleGroup type="multiple">
                    <ToggleGroupItem value="image" aria-label="Toggle image" @click="addImage">
                        <ImageIcon className="h-4 w-4" />
                    </ToggleGroupItem>
                    <!-- <ToggleGroupItem
                        :data-state="editor?.isActive('orderedList') ? 'on' : 'off'"
                        value="orderedList"
                        aria-label="Toggle orderedList"
                        @click="editor?.commands.toggleOrderedList()"
                    >
                        <ListOrdered className="h-4 w-4" />
                    </ToggleGroupItem>
                    <ToggleGroupItem
                        :data-state="editor?.isActive('blockquote') ? 'on' : 'off'"
                        value="blockquote"
                        aria-label="Toggle blockquote"
                        @click="editor?.commands.toggleBlockquote()"
                    >
                        <Quote className="h-4 w-4" />
                    </ToggleGroupItem> -->
                </ToggleGroup>
            </div>
        </div>
        <Separator className="!w-full border" />
        <CardContent className="prose p-2 !max-w-full">
            <editor-content :editor="editor" />
        </CardContent>
    </Card>
</template>
