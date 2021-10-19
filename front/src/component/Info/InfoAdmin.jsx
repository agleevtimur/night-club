import { Input, Button, Form, Modal, Checkbox } from 'antd';
import { useForm } from 'antd/lib/form/Form';
import { useDispatch } from 'react-redux';
import { addVisitor } from '../../redux/action'


const genres = ['rnb', 'hiphop', 'electrohouse', 'electrodance', 'house', 'pop'];

const InfoAdmin = (props) => {
    const dispatch = useDispatch();

    const [form] = useForm();
    const add = () => {
        const visitor = {
            name: form.getFieldValue('name'),
            genre: form.getFieldValue('genre'),
        };

        dispatch(addVisitor(visitor));
        form.resetFields();
    }

    return <Modal title="Admin info" visible={props.visible} footer={[<Button>Next</Button>]} closable={false}>
        <p>As a Admin you have to fill out visitor's info and his music preferences</p>
        <Form onFinish={add} form={form} layout="vertical">
            <Form.Item label="Visitor's name" name="name" rules={[{ required: true }]}>
                <Input placeholder="name" />
            </Form.Item>
            <Form.Item label="What genre he likes" name="genre" rules={[{ required: true }]}> 
                <Checkbox.Group>
                    {genres.map(item => <><Checkbox value={item}>{item}</Checkbox><br/></>)}
                </Checkbox.Group>
            </Form.Item>
            <Form.Item>
                <Button htmlType="submit">sign up visitor</Button>
            </Form.Item>
        </Form>
    </Modal>
}

export default InfoAdmin;