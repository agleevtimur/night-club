import { Input, Button, Form, Modal, Radio } from 'antd';
import { useForm } from 'antd/lib/form/Form';
import { addComposition } from '../../redux/action';
import { useDispatch } from 'react-redux';

const genres = ['rnb', 'hiphop', 'electrohouse', 'electrodance', 'house', 'pop'];
const durationOptions = [10, 15, 20, 30];

const InfoDJ = (props) => {
    const dispatch = useDispatch();
    const [form] = useForm();
    const onAdd = () => {
        const composition = {
            title: form.getFieldValue('title'),
            genre: form.getFieldValue('genre'),
            duration: form.getFieldValue('duration')
        };

        dispatch(addComposition(composition));
        form.resetFields();
    }

    return <Modal title="DJ info" visible={props.visible} footer={[<Button>Go!</Button>]} closable={false}>
        <p>As a DJ you have to define a set of musical compositions that will follow each other</p>
        <p>Please choose some music for us</p>
        <Form onFinish={onAdd} form={form} layout="vertical">
            <Form.Item name="title">
                <Input placeholder="song title" />
            </Form.Item>
            <Form.Item label="song's genre" name="genre"  rules={[{ required: true }]}>
                <Radio.Group>
                    {genres.map(item => <><Radio value={item}>{item}</Radio><br /></>)}
                </Radio.Group>
            </Form.Item>
            <Form.Item label="song's duration" name="duration" rules={[{ required: true }]}>
                <Radio.Group>
                    {durationOptions.map(item => <><Radio value={item}>{item}</Radio><br /></>)}
                </Radio.Group>
            </Form.Item>
            <Form.Item>
                <Button htmlType="submit">add song</Button>
            </Form.Item>
        </Form>
    </Modal>
}

export default InfoDJ;