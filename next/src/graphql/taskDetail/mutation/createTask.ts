import { gql } from '@apollo/client';
import type { Task } from 'models/task';

export const CREATE_TASK_MUTATION = gql`
  mutation CreateTask($input: CreateTaskInput!) {
    createTask(input: $input) {
      id
      title
      text
    }
  }
`;

export interface CreateTask {
  task: Task;
}
